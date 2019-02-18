<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/p2p-dplayer@latest/dist/DPlayer.min.css">
<style type="text/css">
    body,html{width:100%;height:100%;background:#000;padding:0;margin:0;overflow-x:hidden;overflow-y:hidden}
    *{margin:0;border:0;padding:0;text-decoration:none}
    #stats{position:fixed;top:5px;left:10px;font-size:12px;color:#fdfdfd;z-index:2147483647;text-shadow:1px 1px 1px #000, 1px 1px 1px #000}
    #dplayer{position:inherit}
</style>
<div id="dplayer"></div>
<div id="stats"></div>
<script src="//cdn.jsdelivr.net/npm/cdnbye@latest"></script>
<script src="//cdn.jsdelivr.net/npm/p2p-dplayer@latest"></script>
<script>
    var dp = new DPlayer({
        container: document.getElementById('dplayer'),
        autoplay: true,
        video: {
            url: '<?php echo $_GET['url'];?>',
            type: 'hls'
        },
        hlsjsConfig: {
//            debug: false,
            // Other hlsjsConfig options provided by hls.js
            p2pConfig: {
                logLevel: true,
                live: false,        // 如果是直播设为true
                // Other p2pConfig options provided by CDNBye
                // https://docs.cdnbye.com/#/API
            }
        }
    });
    var _peerId = '', _peerNum = 0, _totalP2PDownloaded = 0, _totalP2PUploaded = 0;
    dp.on('stats', function (stats) {
        _totalP2PDownloaded = stats.totalP2PDownloaded;
        _totalP2PUploaded = stats.totalP2PUploaded;
        updateStats();
    });
    dp.on('peerId', function (peerId) {
        _peerId = peerId;
    });
    dp.on('peers', function (peers) {
        _peerNum = peers.length;
        updateStats();
    });

    function updateStats() {
        var text = 'CDNBye P2P正在为您加速' + (_totalP2PDownloaded/1024).toFixed(2)
            + 'MB 已分享' + (_totalP2PUploaded/1024).toFixed(2) + 'MB' + ' 连接节点' + _peerNum + '个';
   //     document.getElementById('stats').innerText = text
    }
</script>