@props([
    'src' => '',
    'poster' => null,
    'videoId' => null,
    'videoGroupId' => null,
])

<div class="video-container" style="position: relative;">
    <!-- Import the videojs-video-element and player.style modules -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/videojs-video-element/+esm"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/player.style/notflix/+esm"></script>

    <style>
        /* Container styles */
        media-theme-notflix {
            display: block;
            width: 100%;
            max-width: 100%;
            height: 720px;
            /* ثبت الارتفاع هنا */
            position: relative;

        }

        media-theme-notflix::part(media) {
            height: 100% !important;
        }


        /* Watermark style */
        .watermark {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            min-width: 90px;
            height: 30px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cinzel Decorative', cursive;
            font-size: 10px;
            font-weight: bold;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            opacity: 0.7;
            text-shadow: 0 0 3px #d4e2fc;
            letter-spacing: 1px;
            padding: 0 10px;
            pointer-events: none;
        }

        /* Import fantasy font for watermark */
        @import url('https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap');
    </style>

    <!-- Notflix theme with custom colors -->
    <media-theme-notflix
        style="--media-primary-color: #ffa8a8; --media-secondary-color: #ffa8a8; --media-accent-color:#ffa8a8;  width: 100%;">
        <videojs-video slot="media"
            src="{{ $src ?: 'https://stream.mux.com/fXNzVtmtWuyz00xnSrJg4OJH6PyNo6D02UzmgeKGkP5YQ.m3u8' }}"
            poster="{{ $poster }}" playsinline crossorigin="anonymous">
        </videojs-video>
    </media-theme-notflix>

    <!-- Watermark script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create watermark element
            function createWatermark() {
                const watermarkDiv = document.createElement('div');
                watermarkDiv.className = 'watermark';
                watermarkDiv.innerHTML = 'veges 1234145';
                return watermarkDiv;
            }

            // Add watermark to player container
            const watermark = createWatermark();
            const container = document.querySelector('.video-container');
            const test = document.querySelector('media-fullscreen-button');

            container.appendChild(watermark);


            // Get the videojs-video element
            const videoElement = document.querySelector('videojs-video');

            // Add event listeners for play/pause to adjust watermark
            videoElement.addEventListener('play', function() {
                watermark.style.opacity = '0.8';
                watermark.style.transition = 'opacity 0.5s ease';
            });

            videoElement.addEventListener('pause', function() {
                watermark.style.opacity = '0.5';
            });
            var videoViewd = false;
            // Add event listener for video time update
            videoElement.addEventListener('timeupdate', function() {

                // Get the actual video element
                const video = document.querySelector('videojs-video');

                if (!video) return;
                if (videoViewd) return;
                // Check if user has watched half of the video
                if (video.currentTime >= (video.duration / 2)) {
                    // Get video ID and group ID from props
                    @if ($videoId && $videoGroupId)
                        // Get CSRF token
                        const csrfToken = '{{ csrf_token() }}';

                        // Check if CSRF token exists
                        if (!csrfToken) {
                            console.error(
                                'CSRF token not found. Make sure the meta tag exists in your layout.');
                            return;
                        }

                        // Send AJAX request to count view using named route
                        fetch(`{{ route('api.video.count.view', [
                            'id' => $videoId,
                            'groupId' => $videoGroupId,
                            'rate' => 0,
                            'isView' => 'true',
                        ]) }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                videoViewd = true;
                            })
                            .catch(error => {
                                // Provide more specific error messages based on error type
                                if (error.name === 'TypeError' && error.message.includes(
                                        'Failed to fetch')) {
                                    console.error(
                                        'Network error: Check your internet connection or server availability'
                                    );
                                } else if (error.name === 'SyntaxError') {
                                    console.error('Invalid JSON response from server');
                                } else {
                                    console.error('Error counting view:', error.message);
                                }
                            });
                    @else
                        console.log('Video view tracking disabled: video or videoGroup not provided');
                    @endif
                }
            });

            // Handle fullscreen changes
            document.addEventListener('media-fullscreen-button', function() {
                if (document.fullscreenElement) {
                    // Adjust watermark for fullscreen
                    watermark.style.fontSize = '12px';
                    watermark.style.minWidth = '110px';
                    watermark.style.height = '36px';
                    watermark.style.top = '30px';
                    watermark.style.right = '30px';
                } else {
                    // Reset watermark size for normal view
                    watermark.style.fontSize = '10px';
                    watermark.style.minWidth = '90px';
                    watermark.style.height = '30px';
                    watermark.style.top = '20px';
                    watermark.style.right = '20px';
                }
            });
        });
    </script>
</div>
