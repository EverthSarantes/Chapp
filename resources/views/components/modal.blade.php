<dialog class="dialog border box-shadow" id="{{$id}}">
    <div class="grid grid-center">
        {{ $slot }}
    </div>
    <div style="height: 40px;"></div>
    <div class="flex justify-contente-end p-2" style="position: absolute; bottom: 5px; right: 0; width: 100%; height: 67px;">
        <button class="close-modal btn gris">Cerrar</button>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.open-modal').forEach((button) => {
            button.addEventListener('click', () => {
                const dialog = document.getElementById(button.dataset.target);
                dialog.showModal();
            });
        });
        document.querySelectorAll('.close-modal').forEach((button) => {
            button.addEventListener('click', () => {
                const dialog = button.closest('dialog');
                dialog.close();
            });
        });
    });
</script>