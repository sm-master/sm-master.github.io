@echo off
REM Set UTF-8 encoding (optional, but may help in some environments)
chcp 65001 >nul

echo ------------------------------
echo Current directory: %cd%
echo ------------------------------

git rev-parse --is-inside-work-tree >nul 2>&1
IF %errorlevel% NEQ 0 (
    echo Not a Git repository.
    goto end
)

echo This is a Git repository.

echo.
echo Current branch:
git rev-parse --abbrev-ref HEAD

echo.
echo Remote repository:
git remote -v

echo.
echo Git status:
git status -sb

:end
pause