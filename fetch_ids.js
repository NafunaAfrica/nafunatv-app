const fetchId = async (q) => {
  const r = await fetch('https://www.youtube.com/results?search_query=' + encodeURIComponent(q));
  const t = await r.text();
  const match = t.match(/"videoId":"([a-zA-Z0-9_-]{11})"/);
  return match ? match[1] : null;
};
Promise.all([
  'Nafuna TV Angry Mwana',
  'Nafuna TV The Couch',
  'Nafuna TV Twunyaya',
  'Nafuna TV Nafuna Campus',
  'Nafuna TV Animation Behind Scenes'
]).then(res => console.log(JSON.stringify(res)));
