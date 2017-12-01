# VTP
The VTP server stores Everybody Votes Channel votes/question suggestions that the Wii sends to it. It also has a time server the Wii uses to sync the time with.

- `suggest.cgi` is the script that stores question suggestions.
- `time.cgi` returns a Last-Modified header with the latest time. It will need to have an alias to to index.html, because that's what the Wii loads for the time.
- `vote.cgi` is the script that stores votes.

As of right now the scripts are not connected to SSL.

# Config
- Line 10 - MySQL Database, Username, and Password.
- `$sentryurl` - this is the Sentry URL for error logging.