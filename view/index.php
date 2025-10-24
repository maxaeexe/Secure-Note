<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link rel="stylesheet" href="/view/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Secure<span>Note</span></div>
            <p class="tagline">Güvenli, şifreli ve anonim not paylaşımı</p>
             <p class="tagline"><a href="https://github.com/maxaeexe/Secure-Note">https://github.com/maxaeexe/Secure-Note</a></p>
        </header>

        <div class="main-content">
            <div class="tab-container">
                <div class="tab active" onclick="switchTab('create')">Not Oluştur</div>
                <div class="tab" onclick="switchTab('view')">Not Görüntüle</div>
            </div>

            <!-- NOT OLUŞTURMA SEKMESİ -->
            <div id="create" class="tab-content active">
                <div class="card">
                    <h2 style="margin-bottom: 20px; font-weight: 300;">Yeni Güvenli Not</h2>
                    
                    <form id="noteForm" method="POST" action="/not_ekle">
                        <div class="form-group">
                            <label for="noteContent">Not İçeriği</label>
                            <textarea name="metin" id="noteContent" placeholder="Notunuzu buraya yazın..."></textarea>
                        </div>
                        <div class="options-grid">
                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input name="pass" type="password" id="password" placeholder="Şifre belirleyin">
                            </div>
                        </div>
                        <div class="info-box">
                            <p>🔒 Notunuz güvenlik açısından backend de şifrelenir</p>
                            <p>🚫 Sunucuda tamamen şifreli saklanır</p>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary">Temizle</button>
                            <button type="submit" class="btn">Not Oluştur</button>
                        </div>
                        <input type="hidden" name="token" value="<?=csrf::token_olustur();?>">
                    </form>

                    <div id="linkResult">
                        <h3 style="margin-top: 30px; margin-bottom: 15px; font-weight: 300;">Paylaşım ID'niz</h3>
                        <div class="link-display">
                            <input type="text" id="generatedLink" value="<?php if(isset($_SESSION["not_id"])) echo htmlspecialchars($_SESSION["not_id"]); unset($_SESSION["not_id"]);?>" readonly>
                            <button class="copy-btn" onclick="copyLink()">Kopyala</button>
                        </div>
                        <p style="color: #888; font-size: 0.85rem; margin-top: 10px;">
                            ⚠️ Bu linki güvenli bir şekilde paylaşın. Link kopyalandıktan sonra bu sayfayı kapatabilirsiniz.
                        </p>
                    </div>
                </div>
            </div>

            <!-- NOT GÖRÜNTÜLEME SEKMESİ -->
            <div id="view" class="tab-content">
                <div class="card">
                    <h2 style="margin-bottom: 20px; font-weight: 300;">Not Görüntüle</h2>
                    
                    <form id="viewForm" method="POST" action="/not_goruntule">
                        <div class="form-group">
                            <label for="noteId">Not ID veya Link</label>
                            <input name="not_id" type="text" id="noteId" placeholder="Not ID'sini veya linki yapıştırın">
                        </div>

                        <div class="form-group">
                            <label for="viewPassword">Şifre (gerekiyorsa)</label>
                            <input name="pass" type="password" id="viewPassword" placeholder="Not şifresi">
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn">Notu Görüntüle</button>
                        </div>
                        <input type="hidden" name="token" value="<?=csrf::token_olustur();?>">
                    </form>

                    <div id="noteDisplay" style=" margin-top: 30px;">
                        <h3 style="margin-bottom: 15px; font-weight: 300;">Not İçeriği</h3>
                        <div style="background: #0a0a0a; padding: 20px; border-radius: 6px; border: 1px solid #333;">
                            <pre id="displayedNote" style="white-space: pre-wrap; font-family: 'Courier New', monospace; color: #e0e0e0;"><?php if(isset($_SESSION["acilmis_metin"])) echo htmlspecialchars($_SESSION["acilmis_metin"]); unset($_SESSION["acilmis_metin"]);?></pre>
                        </div>
                        <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #888; font-size: 0.85rem;" id="noteInfo"></span>
                            <button class="btn btn-secondary" onclick="copyNoteContent()">İçeriği Kopyala</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">256-bit</div>
                    <div class="stat-label">AES Şifreleme</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?=$toplam;?></div>
                    <div class="stat-label">Veri Saklama</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Anonim</div>
                </div>
            </div>
        </div>

        <footer>
            <p>SecureNote - Açık kaynaklı ve şifreli not paylaşımı</p>
            <p style="margin-top: 5px;">Notlarınız tamamen şifrelidir ve sunucuda plain text olarak saklanmaz</p>
        </footer>
    </div>
    <script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');
        
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.getElementById(tabName).classList.add('active');

        localStorage.setItem('activeTab', tabName);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const activeTab = localStorage.getItem('activeTab') || 'create';
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        document.querySelector(`.tab[onclick="switchTab('${activeTab}')"]`).classList.add('active');
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        document.getElementById(activeTab).classList.add('active');
    });
</script>

    <script>


        function copyLink() {
            const link = document.getElementById('generatedLink');
            link.select();
            document.execCommand('copy');
            
            const btn = event.target;
            btn.textContent = 'Kopyalandı!';
            setTimeout(() => {
                btn.textContent = 'Kopyala';
            }, 2000);
        }

        function copyNoteContent() {
            const content = document.getElementById('displayedNote').textContent;
            navigator.clipboard.writeText(content);
            
            event.target.textContent = 'Kopyalandı!';
            setTimeout(() => {
                event.target.textContent = 'İçeriği Kopyala';
            }, 2000);
        }


        document.querySelector('.btn-secondary').addEventListener('click', function() {
            document.getElementById('noteContent').value = '';
            document.getElementById('password').value = '';
            document.getElementById('burnAfterRead').checked = false;
            document.getElementById('linkResult').style.display = 'none';
        });
    </script>
</body>
</html>