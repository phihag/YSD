from sys import argv
from youtube_dl.extractor import YoutubeIE
from youtube_dl.utils import write_string

class Downloader(object):

    def __init__(self):
        self.params={}

    def report_warning(self, msg):
        pass
		
    def to_screen(self, msg):
        pass	


class YoutubeInfoExtractor(YoutubeIE):

    def __init__(self, *args, **kwargs):
        super(YoutubeInfoExtractor, self).__init__(*args, **kwargs)

    def _decrypt_signature(self, s, video_id, player_url, age_gate=False):
        return super(YoutubeInfoExtractor, self)._decrypt_signature(s, video_id, player_url, age_gate)



if __name__ == "__main__":
    sig = argv[1]
    vid = argv[2]
    url = argv[3]

    sig_extractor = YoutubeInfoExtractor(Downloader())
    if sig and vid and url:
        print(sig_extractor._decrypt_signature(sig,vid,url,False))