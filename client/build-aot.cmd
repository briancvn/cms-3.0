@IF EXIST "%~dp0\node.exe" (
    "%~dp0\node.exe"  "%~dp0\generate\generate" %*
    ng build --prod --source-map --base-href /cms/
    if ERRORLEVEL EQU 1 (
        echo Build AOT falied...
        node  "%~dp0\generate\reverse" %*
    )
) ELSE (
    @SETLOCAL
    @SET PATHEXT=%PATHEXT:;.JS;=;%
    node  "%~dp0\generate\generate" %*
    ng build --prod --source-map --base-href /cms/
    if ERRORLEVEL EQU 1 (
        echo Build AOT falied...
        node  "%~dp0\generate\reverse" %*
    )
)