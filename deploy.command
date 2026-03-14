#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"
REPO_ROOT="$PWD"
DEFAULT_WP_PATH="$REPO_ROOT/app/public"
LOCAL_WP_PATH="$HOME/Local Sites/starsforeurope/app/public"
EXPORT_PATH="$REPO_ROOT/app/sql/local.sql"

status=0
export WP_CLI_SILENCE_PHP_WARNINGS=1

# mysql-client is keg-only on macOS; expose mysql/mysqldump for wp-cli.
if command -v brew >/dev/null 2>&1; then
  MYSQL_BIN="$(brew --prefix mysql-client 2>/dev/null || true)/bin"
  if [[ -d "$MYSQL_BIN" ]] && [[ ":$PATH:" != *":$MYSQL_BIN:"* ]]; then
    export PATH="$MYSQL_BIN:$PATH"
  fi
fi

# Prefer Local's active MySQL socket to avoid default /tmp/mysql.sock issues.
LOCAL_MYSQL_SOCKET="$(ls -1t "$HOME/Library/Application Support/Local/run"/*/mysql/mysqld.sock 2>/dev/null | head -n 1 || true)"
if [[ -n "$LOCAL_MYSQL_SOCKET" && -S "$LOCAL_MYSQL_SOCKET" ]]; then
  export MYSQL_UNIX_PORT="$LOCAL_MYSQL_SOCKET"
fi

echo "Before deploy: click 'Generate' in Simply Static to refresh docs/."
read -r -p "Press Enter to continue once static export is done... "

WP_PATH=""
if [[ -f "$DEFAULT_WP_PATH/wp-load.php" ]]; then
  WP_PATH="$DEFAULT_WP_PATH"
elif [[ -f "$LOCAL_WP_PATH/wp-load.php" ]]; then
  WP_PATH="$LOCAL_WP_PATH"
fi

if [[ -z "$WP_PATH" ]]; then
  echo "Error: could not find a valid WordPress path."
  echo "Checked:"
  echo "  - $DEFAULT_WP_PATH"
  echo "  - $LOCAL_WP_PATH"
  status=1
fi

if [[ "$status" -eq 0 ]] && ! command -v wp >/dev/null 2>&1; then
  echo "Error: wp-cli is not installed or not in PATH."
  echo "Install with: brew install wp-cli"
  status=1
fi

if [[ "$status" -eq 0 ]]; then
  mkdir -p app/sql

  # Hide php8.4 deprecation spam emitted by wp-cli internals.
  export WP_CLI_PHP_ARGS="-d error_reporting=E_ERROR -d display_errors=0"

  set +e
  wp --path="$WP_PATH" db export "$EXPORT_PATH"
  status=$?
  set -e

  if [ "$status" -ne 0 ]; then
    echo "DB export failed. Ensure Local site 'starsforeurope' is running, then retry."
  fi

  if [ "$status" -eq 0 ]; then
    git add app/ docs/
    if git diff --cached --quiet; then
      echo "No changes to commit."
    else
      git commit -m "content: $(date '+%Y-%m-%d %H:%M:%S')"
      git push
      echo "Deploy flow complete."
    fi
  fi
fi

echo
if [ "$status" -eq 0 ]; then
  echo "Done."
else
  echo "Failed with exit code $status."
fi

read -r -n 1 -s -p "Press any key to close..."
echo

exit "$status"
