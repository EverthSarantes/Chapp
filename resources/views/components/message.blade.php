<div class="{{ $color }}" id="message">
    <p>{{ $mensage }}</p>
    <script>
        setTimeout(() => {
            document.getElementById('message').remove();
        }, 5000);
        document.getElementById('message').addEventListener('click', () => {
            document.getElementById('message').remove();
        });
    </script>
</div>