#!/usr/bin/env bash
set -euo pipefail

TARGET_REPO="$(cd "$(dirname "$0")" && pwd)"
TARGET_SITE="starsforeurope"
LOCAL_SITE_DIR="$HOME/Local Sites/$TARGET_SITE"
IMPORT_ZIP="$TARGET_REPO/starsforeurope.zip"

check_cmd() {
  local cmd="$1"
  local hint="$2"
  if ! command -v "$cmd" >/dev/null 2>&1; then
    echo "Error: '$cmd' is required. $hint"
    exit 1
  fi
}

ensure_brew_package() {
  local package="$1"
  local command_name="$2"

  if command -v "$command_name" >/dev/null 2>&1; then
    return 0
  fi

  if ! command -v brew >/dev/null 2>&1; then
    echo "Error: Homebrew is required to install '$package'."
    echo "Install Homebrew first: https://brew.sh"
    exit 1
  fi

  echo "==> Installing missing dependency: $package"
  brew install "$package"
}

echo "==> Checking prerequisites"
check_cmd git "Install with: brew install git"
ensure_brew_package wp-cli wp
ensure_brew_package mysql-client mysqldump

# mysql-client is keg-only on macOS; add it for this script session.
if command -v brew >/dev/null 2>&1; then
  MYSQL_BIN="$(brew --prefix mysql-client)/bin"
  if [[ -d "$MYSQL_BIN" ]] && [[ ":$PATH:" != *":$MYSQL_BIN:"* ]]; then
    export PATH="$MYSQL_BIN:$PATH"
  fi
fi

if [[ ! -d "/Applications/Local.app" ]] && ! command -v local >/dev/null 2>&1; then
  echo "Error: Local is not installed. Install from https://localwp.com/releases/"
  exit 1
fi

echo "==> Building import ZIP at $IMPORT_ZIP"
TMP_DIR="$(mktemp -d)"
trap 'rm -rf "$TMP_DIR"' EXIT

mkdir -p "$TMP_DIR/app/sql" "$TMP_DIR/app/public"

if [[ ! -f "$TARGET_REPO/app/sql/local.sql" ]]; then
  echo "Error: missing $TARGET_REPO/app/sql/local.sql"
  exit 1
fi

# Guardrail: prevent silent onboarding from a default/empty WordPress dump.
if grep -q "Hello world!" "$TARGET_REPO/app/sql/local.sql" && grep -q "Sample Page" "$TARGET_REPO/app/sql/local.sql"; then
  echo
  echo "WARNING: app/sql/local.sql looks like a default WordPress database dump."
  echo "It contains sample content (e.g. Hello world / Sample Page)."
  echo "If you continue, Local will import that default content."
  read -r -p "Type CONTINUE to proceed anyway: " confirm_default_dump
  if [[ "$confirm_default_dump" != "CONTINUE" ]]; then
    echo "Aborted. Export the correct DB first, then run setup again."
    exit 1
  fi
fi

if [[ ! -d "$TARGET_REPO/app/public/wp-content" ]]; then
  echo "Error: missing $TARGET_REPO/app/public/wp-content"
  exit 1
fi

cp "$TARGET_REPO/app/sql/local.sql" "$TMP_DIR/app/sql/local.sql"
cp -R "$TARGET_REPO/app/public/wp-content" "$TMP_DIR/app/public/wp-content"

rm -f "$IMPORT_ZIP"
(
  cd "$TMP_DIR"
  zip -rq "$IMPORT_ZIP" app
)

echo
echo "Next step in Local:"
echo "1) Create or open site '$TARGET_SITE'"
echo "2) Import by dragging this ZIP into Local:"
echo "   $IMPORT_ZIP"
echo "3) Use site name: $TARGET_SITE"
read -r -p "Press Enter after Local import is finished... "

if [[ ! -d "$LOCAL_SITE_DIR/app/public" ]]; then
  echo "Error: Local site public path not found: $LOCAL_SITE_DIR/app/public"
  exit 1
fi

echo "==> Linking Local wp-content to repository"
LOCAL_WP_CONTENT="$LOCAL_SITE_DIR/app/public/wp-content"
REPO_WP_CONTENT="$TARGET_REPO/app/public/wp-content"

if [[ ! -d "$REPO_WP_CONTENT" ]]; then
  echo "Error: missing repository wp-content at $REPO_WP_CONTENT"
  exit 1
fi

if [[ -L "$LOCAL_WP_CONTENT" ]]; then
  rm -f "$LOCAL_WP_CONTENT"
elif [[ -d "$LOCAL_WP_CONTENT" ]]; then
  mv "$LOCAL_WP_CONTENT" "${LOCAL_WP_CONTENT}.backup.$(date +%Y%m%d%H%M%S)"
fi

ln -s "$REPO_WP_CONTENT" "$LOCAL_WP_CONTENT"

echo
echo "Done. Local site now uses repo wp-content: $REPO_WP_CONTENT"
