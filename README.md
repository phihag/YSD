# YSD

**YouTube Signature Decrypter**


# DESCRIPTION

A (serverside) python helper for decrypting youtube videos signatures.
The actual signature decrypter is provided by [https://github.com/rg3/youtube-dl/](https://github.com/rg3/youtube-dl/) which is required to be available on the same machine for the script to work.


# CONFIGURATION

Point the `_sighelper.py` to the signature decrypter in your `youtube-dl` copy:

	...
	from youtube_dl.extractor import YoutubeIE
	from youtube_dl.utils import write_string
	...

# ARGS

	arg[1]: encrypted signature.
	arg[2]: video id.
	arg[3]: Video player url.
	
	
#Output

	decrypted signature
	
 
#Example:

	$ _sighelper 2632A05256F6B7C1B4A133C5E22E2AC1FE6D36996.DC02CDEDFEA0911562A5D59533693512B0D25242242 oRdxUFDoQe0 http://s.ytimg.com/yts/jsbin/html5player-vflO-N-9M.js

	
#Wrapper

`_sig.php` is a php wrapper for `_sighelper.py`. Its content is pretty much self-explanatory.

Feel free to submit any other wrapper that might be helpful to others. Thanks.