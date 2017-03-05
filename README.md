# DirSync
A folder list sync between Server and Client (originally designed for use with a Plex environment)

## Installation

1. Clone the git repository `git clone https://github.com/PXgamer/PlexCron.git`
2. Copy the Client folder contents to your Plex content location (must be publicly accessible)
3. Copy the Server folder to anywhere (could be a web server that's public, or otherwise)
4. In `public/Client/index.php` edit the variables to choose the Server URL
5. In `src/App.php` edit the top 4 constants in order to set:
    - HASH (this is a unique ID that should be different per server, works as authentication)
    - RECEIVER_URL (this defines the server endpoint that the client will send to)
    - CLIENT_NAME (this is to define your Client's name that's sent to the server)
    - SERVER_NAME (this is to define your Server's name)
7. Access the `public/CLient/index.php` file on your server
8. When run, you should be greeted with the following:
   ```json
   {
    "status": "success"
   }
   ```
   if not, you will be met with:
   ```json
   {
    "status": "unauthorised"
   }
   ```
