# PlexCron
A folder list sync between Server and Client (designed for use with a Plex environment)

[![GitHub release](https://img.shields.io/github/release/PXgamer/PlexCron.svg)](https://github.com/PXgamer/PlexCron/releases/latest) [![Scrutinizer Build](https://img.shields.io/scrutinizer/build/g/PXgamer/PlexCron.svg)](https://scrutinizer-ci.com/g/PXgamer/PlexCron/build-status/master) [![SensioLabs Insight](https://img.shields.io/sensiolabs/i/9c87804b-d448-4fcf-8c10-9e366518292c.svg)](https://insight.sensiolabs.com/projects/9c87804b-d448-4fcf-8c10-9e366518292c)

## Installation

1. Clone the git repository `git clone https://github.com/PXgamer/PlexCron.git`
2. Copy the Client folder contents to your Plex content location (must be publicly accessible)
3. Copy the Server folder to anywhere (could be a web server that's public, or otherwise)
4. In `Client/index.php` edit the variables to choose the Server URL
5. In `Client/PlexCronClient.php` edit the top 4 variables in order to set:
    - Sender Name (this is to define your Client's name that's sent to the server)
    - Movie Path (this defines the location that your Movie folders are in)
    - TV Path (this defines the location that your TV Show folders are in)
    - Hash (this is a unique ID that should be different per server, works as authentication)
6. In `Server/PlexCronReceiver.php` edit the top 4 variables in order to set:
    - Server Name (the name that will be sent back to the Client)
    - Movies Text Path (this is the file that the movies will be written to)
    - TV Text Path (this is the file that the TV shows will be written to)
    - Hash (this is a unique ID that must match the hash in `PlexCronClient.php`)
7. Access the `Client/index.php` file on your server
8. When run, you should be greeted with the following:
   ```json
   {
    "Status": "Success",
    "Sender": "PlexCronServer"
   }
   ```
   if not, you will be met with:
   ```json
   {
    "Status": "Unauthorised"
   }
   ```
