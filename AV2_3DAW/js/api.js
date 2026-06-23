async function chamarApi(url, dados) {
    const opcoes = { headers: { 'X-Requested-With': 'fetch' } };
    if (dados) {
        const fd = new FormData();
        Object.entries(dados).forEach(([k, v]) => fd.append(k, v));
        opcoes.method = 'POST';
        opcoes.body = fd;
    }
    const resp = await fetch(url, opcoes);
    let json = null;
    try { json = await resp.json(); } catch (e) { }
    return { status: resp.status, json: json || {} };
}
