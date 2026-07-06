async function exigirLogin() {
    try {
        const r = await fetch('api/sessao.php', { credentials: 'same-origin' });
        const j = await r.json();
        if (!j.ok) { location.href = 'login.html'; return false; }
        return true;
    } catch (e) {
        location.href = 'login.html';
        return false;
    }
}

function montarTopo({ titulo, mostrarSair = false } = {}) {
    if (titulo) document.title = titulo;
    const sair = mostrarSair
        ? '<div class="sair"><a href="#" id="link-sair">Sair</a></div>'
        : '';
    const html = '<header class="topo"><h1>Simone Belezas</h1></header>' + sair;
    document.body.insertAdjacentHTML('afterbegin', html);
    if (mostrarSair) {
        document.getElementById('link-sair').addEventListener('click', async (e) => {
            e.preventDefault();
            try {
                await fetch('api/logout.php', {
                    headers: { 'X-Requested-With': 'fetch' },
                    credentials: 'same-origin'
                });
            } catch (_) {}
            location.href = 'login.html';
        });
    }
}
