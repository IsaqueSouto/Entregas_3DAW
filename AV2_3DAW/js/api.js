async function chamarApi(url, dados) {
    const opcoes = { headers: { 'X-Requested-With': 'fetch' } };
    if (dados) {
        const fd = new FormData();
        for (let k in dados) {
        fd.append(k, dados[k]);
    }
        opcoes.method = 'POST';
        opcoes.body = fd;
    }
    const resp = await fetch(url, opcoes);
    let json = null;
    try { json = await resp.json(); } catch (e) {  }
    return { status: resp.status, json: json || {} };
}
