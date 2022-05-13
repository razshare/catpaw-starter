# Debugging with VSCode

In order to debug with vscode you will need to configure both vscode and xdebug (3.x).

### VSCode configuration

Make new  `./.vscode/launch.json` file in your project and add your configuration:
```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen (paw)",
            "type": "php",
            "request": "launch",
            "port": 9003
        },
        {
            "name": "Launch (paw)",
            "type": "php",
            "request": "launch",
            "program": "${workspaceFolder}/vendor/catpaw/core/scripts/start.php",
            "cwd": "${workspaceFolder}",
            "args": [
                "${file}"
            ],
            "port": 0,
            "runtimeArgs": [
                "-dxdebug.start_with_request=yes"
            ],
            "env": {
                "XDEBUG_MODE": "debug,develop",
                "XDEBUG_CONFIG": "client_port=${port}"
            }
        }
    ]
}
```

The first configuration will passively listen for xdebug, while the second one will launch the currently opened script.

### XDebug 3.x configuration

In you `php.ini` file add:
```ini
[xdebug]
xdebug.mode=debug
xdebug.client_host=127.0.0.1
xdebug.client_port=9003
xdebug.start_with_request=yes
```