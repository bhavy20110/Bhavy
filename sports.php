<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M3UMERGERS PLAY - LINK</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href="https://i.ibb.co/t8PFZNB/20231219-100949.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.6.2/dist/plyr.css">
    
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.6.12/dist/plyr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@1.1.4/dist/hls.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <style>
        /* General Styles */
        html, body {
            font-family: 'Poppins', sans-serif;
            background: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        video {
            width: 100%;
            max-width: 600px;
            background: #000;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 30px;
            cursor: pointer;
        }

        .modal-buttons button {
            padding: 10px;
            width: 45%;
            margin: 10px 2%;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #joinChannel {
            background-color: #1a73e8;
            color: #fff;
        }

        #alreadyJoined {
            background-color: #f44336;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Video Player -->
    <video id="player" controls poster="https://i.ibb.co/Tt7JCk9/20241113-111016.png" playsinline>
        <source id="m3u8-url" src="" type="application/x-mpegURL">
    </video>

    <!-- Telegram Join Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Join Our Telegram Channel</h2>
            <p>Stay updated with the latest streams and news.</p>
            <div class="modal-buttons">
                <button id="joinChannel">Join Now</button>
                <button id="alreadyJoined">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Parse URL parameter for stream source
        const urlParams = new URLSearchParams(window.location.search);
        const streamURL = urlParams.get('id');
        
        if (streamURL) {
            const video = document.getElementById('player');
            const source = document.getElementById('m3u8-url');

            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource(streamURL);
                hls.attachMedia(video);
            } else {
                video.src = streamURL;
            }
        } else {
            console.error("No stream URL provided.");
        }

        // Modal Handling
        const modal = document.getElementById("myModal");
        const closeModal = document.getElementById("closeModal");
        const joinChannel = document.getElementById("joinChannel");

        // Show modal on load
        modal.style.display = "flex";

        closeModal.onclick = () => modal.style.display = "none";
        joinChannel.onclick = () => window.open("https://t.me/BhavyaPatel77", "_blank");
    </script>

</body>
</html>
