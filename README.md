wp-status
=========

WordPress plugin. Show load and database status in JSON format for external monitoring software.

After installing and activating the plugin, navigate to the following url to get the status report:
http://site.com/?wp-db-status=1

Status reports look like this:

```json
{

    "status": "OK",
    "db_uptime": "0 days, 00:07",
    "generation_time": "1,26",
    "load_1m": "0",
    "load_5m": "0",
    "load_15m": "0"

}
```

You can observe the database uptime, page generation time (for the status call), and server load.

If the database is down, you will get the WordPress default error page, with an error 500 code. Most monitoring tools
are able to detect this and trigger an error.
