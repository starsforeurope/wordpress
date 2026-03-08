#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

status=0

echo "Before deploy: click 'Generate' in Simply Static to refresh docs/."
read -r -p "Press Enter to continue once static export is done... "

if ! command -v wp >/dev/null 2>&1; then
  echo "Error: wp-cli is not installed or not in PATH."
  echo "Install with: brew install wp-cli"
  status=1
else
  mkdir -p app/sql

  set +e
  wp --path=app/public db export app/sql/local.sql
  status=$?
  set -e

  if [ "$status" -eq 0 ]; then
    git add .
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
