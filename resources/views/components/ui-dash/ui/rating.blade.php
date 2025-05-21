@props([
    'is_rating' => false,
    'rating_count' => 0,
    'id' => '',
    'videoId' => null,
    'videoGroupId' => null,
])

@php
    $rating = $rating_count ?? 0;
    $ratingClass = match (true) {
        $rating >= 5 => 'happy',
        $rating >= 4 => 'good',
        $rating >= 3 => 'ok',
        $rating >= 2 => 'sad',
        $rating >= 1 => 'angry',
        default => 'happy',
    };
@endphp
{{-- Show single icon when is_rating is false --}}
@if (!$is_rating)
    <div class="feedback justify-content-center">
        <label class="{{ $ratingClass }}">
            <input type="radio" disabled name="show{{ $id }}" checked />
            <div>
                <svg class="eye left">
                    <use xlink:href="#eye">
                </svg>
                <svg class="eye right">
                    <use xlink:href="#eye">
                </svg>
                <svg class="mouth">
                    <use xlink:href="#mouth">
                </svg>
            </div>
        </label>
    </div>
@endif

{{-- Show full rating interface when is_rating is true --}}
@if ($is_rating)
    <div class="d-flex align-items-center">
        <div class="feedback" id="rating-feedback-{{ $id }}">
            <label class="angry">
                <input type="radio" value="1" name="feedback" class="rating-input" @if($rating == 1) checked @endif/>
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="sad">
                <input type="radio" value="2" name="feedback" class="rating-input" @if($rating == 2) checked @endif />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="ok">
                <input type="radio" value="3" name="feedback" class="rating-input" @if($rating == 3) checked @endif />
                <div></div>
            </label>
            <label class="good">
                <input type="radio" value="4" name="feedback" class="rating-input" @if($rating == 4) checked @endif />
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="mouth">
                        <use xlink:href="#mouth">
                    </svg>
                </div>
            </label>
            <label class="happy">
                <input type="radio" value="5" name="feedback" class="rating-input" @if($rating == 5) checked @endif/>
                <div>
                    <svg class="eye left">
                        <use xlink:href="#eye">
                    </svg>
                    <svg class="eye right">
                        <use xlink:href="#eye">
                    </svg>
                </div>
            </label>
        </div>
        <div id="rating-message-{{ $id }}" class="ms-2" style="display: none;">
            <small class="text-success">Thank you for your rating!</small>
        </div>
    </div>

    @if ($videoId && $videoGroupId)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ratingContainer = document.getElementById('rating-feedback-{{ $id }}');
                const ratingMessage = document.getElementById('rating-message-{{ $id }}');
                const ratingInputs = ratingContainer.querySelectorAll('.rating-input');

                ratingInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const ratingValue = this.value;
                        const csrfToken = '{{ csrf_token() }}';
                        const videoId = '{{ $videoId }}';
                        const videoGroupId = '{{ $videoGroupId }}';

                        // Send AJAX request to count view using named route
                        fetch(`/app/video-count-view/${videoId}/${videoGroupId}/${ratingValue}/0`, {
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
                                // Show success message
                                ratingMessage.style.display = 'block';
                                console.log(data);


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
                                    console.error('Error submitting rating:', error.message);
                                }
                            });
                    });
                });
            });
        </script>
    @endif
@endif

{{-- SVG definitions (moved outside conditional block to be accessible to both parts) --}}
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
        <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1">
        </path>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
        <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5">
        </path>
    </symbol>
</svg>
