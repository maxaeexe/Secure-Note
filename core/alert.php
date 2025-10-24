
<style>
.custom-toast{
        position: fixed;
        right: 20px;
        top: 20px;
        min-width: 220px;
        max-width: 320px;
        background: rgba(20, 20, 20, 0.7);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        padding: 12px 16px;
        border-radius: 10px;
        box-shadow: 0 6px 24px rgba(0,0,0,0.35);
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity .28s ease, transform .28s ease;
        z-index: 9999;
    }
    .custom-toast.show { opacity: 1; transform: translateY(0); }
    .custom-toast .title { font-weight: 600; margin-bottom: 6px; }
    .custom-toast .close-btn { position: absolute; right: 8px; top: 6px; cursor: pointer; font-size: 14px; opacity: .7; }
</style>
<?php

    if (!empty($_SESSION['alert']) && $_SESSION['alert'] != "") {
        $alert = $_SESSION['alert'];
        $_SESSION['alert'] = "";
        ?>

        <div id="phpToast" class="custom-toast" role="status" aria-live="polite">
            <span class="title">Bildirim</span>
            <div class="message"><?= htmlspecialchars($alert, ENT_QUOTES) ?></div>
            <span id="toastCloseBtn" class="close-btn">✕</span>
        </div>

        <script>
        const toast = document.getElementById('phpToast');
        const closeBtn = document.getElementById('toastCloseBtn');

        // toast göster
        setTimeout(() => toast.classList.add('show'), 20);

        // 2 saniye sonra otomatik gizle
        let hideTimeout = setTimeout(hideToast, 2000);

        // manuel kapatma
        closeBtn.addEventListener('click', hideToast);

        // fareyle üzerine gelince otomatik gizlemeyi durdur
        toast.addEventListener('mouseenter', () => clearTimeout(hideTimeout));
        toast.addEventListener('mouseleave', () => hideTimeout = setTimeout(hideToast, 1000));

        // hide fonksiyonu
        function hideToast(){
            toast.classList.remove('show');
            setTimeout(() => {
                if(toast && toast.parentNode) toast.parentNode.removeChild(toast);
            }, 400);
        }
        </script>
        <?php
    }
?>