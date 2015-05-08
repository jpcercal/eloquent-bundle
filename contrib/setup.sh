#!/usr/bin/env bash

git config core.fileMode false

cp contrib/pre-commit.php .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
