# Debugging with VSCode

In order to debug with vscode you will need to configure both vscode and xdebug (3.x).

### VSCode configuration

Make new a `./.vscode/launch.json` file in your project and add the following configuration if you don't have it already:
```json
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Listen (paw)",
      "type": "php",
      "request": "launch",
      "port": 9003,
      "runtimeArgs": ["-dxdebug.start_with_request=yes", "-dxdebug.mode=debug"]
    },
    {
      "name": "Launch (paw)",
      "type": "php",
      "request": "launch",
      "program": "${workspaceFolder}/vendor/catpaw/core/scripts/start.php",
      "cwd": "${workspaceFolder}",
      "args": ["${file}"],
      "port": 0,
      "runtimeArgs": ["-dxdebug.start_with_request=yes", "-dxdebug.mode=debug"],
      "env": {
        "XDEBUG_MODE": "debug,develop",
        "XDEBUG_CONFIG": "client_port=${port}"
      }
    }
  ]
}
```

The first configuration will passively listen for xdebug, while the second one will launch the currently opened script.

### XDebug 3.x configuration for VSCode

In you `php.ini` file add:
```ini
[xdebug]
xdebug.client_host=127.0.0.1
xdebug.client_port=9003
```

# Debugging with PHPStorm

If you're using PHPStorm you will need to start listening for PHP Xdebug connections.

First off pick your php interpreter:

![image](https://user-images.githubusercontent.com/6891346/168439592-3c8609aa-2d30-4995-ace3-8fa19fcef4b0.png)

Then start listening for xdebug connections: ![image](https://user-images.githubusercontent.com/6891346/168439662-558102d8-a94d-4480-a4e5-324f85a47cab.png)

### Xdebug 3.x configuration for PHPStorm

```ini
xdebug.mode=debug
xdebug.client_host=127.0.0.1
xdebug.client_port=9003
xdebug.start_with_request=yes
```

# Run & Watch

You should now be able to run your project in production mode with 
```bash
./start
```
or in watch mode with
```bash
./watch
```

and debug in both modes with both vscode and phpstorm listening for xdebug connections.
