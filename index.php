<?php
require_once 'config.php'; $page_title='Book Catalogue'; $q=trim($_GET['q']??''); $cat=trim($_GET['category']??''); $page=max(1,(int)($_GET['page']??1)); $limit=6;
$where=[];$params=[];$types='';
if($q!==''){ $where[]='(title LIKE ? OR author LIKE ?)'; $like="%$q%"; $params[]=$like;$params[]=$like;$types.='ss'; }
if($cat!==''){ $where[]='category=?';$params[]=$cat;$types.='s'; }
$w=$where?'WHERE '.implode(' AND ',$where):'';
$cs=$conn->prepare("SELECT COUNT(*) total FROM books $w"); if($types)$cs->bind_param($types,...$params);$cs->execute();$total=(int)$cs->get_result()->fetch_assoc()['total'];$pages=max(1,(int)ceil($total/$limit));$page=min($page,$pages);$offset=($page-1)*$limit;
$s=$conn->prepare("SELECT * FROM books $w ORDER BY id DESC LIMIT ? OFFSET ?");$p=$params;$p[]=$limit;$p[]=$offset;$s->bind_param($types.'ii',...$p);$s->execute();$books=$s->get_result();$cats=$conn->query('SELECT DISTINCT category FROM books ORDER BY category');
include 'header.php'; ?>
<section class="hero"><p>YOUR NEXT GREAT READ</p><h1>Stories for every kind of reader.</h1><span>Browse books, search by title or author, and discover something new.</span></section>
<form class="search" method="get"><input name="q" placeholder="Search title or author" value="<?= htmlspecialchars($q) ?>"><select name="category"><option value="">All categories</option><?php while($c=$cats->fetch_assoc()): ?><option <?= $cat===$c['category']?'selected':'' ?> value="<?= htmlspecialchars($c['category']) ?>"><?= htmlspecialchars($c['category']) ?></option><?php endwhile; ?></select><button>Search</button></form>
<h2>Book catalogue <small>(<?= $total ?> results)</small></h2><div class="grid"><?php if(!$books->num_rows) echo '<p>No books found.</p>'; while($b=$books->fetch_assoc()): ?><article class="card"><div class="cover">📖</div><div class="pad"><small class="tag"><?= htmlspecialchars($b['category']) ?></small><h3><?= htmlspecialchars($b['title']) ?></h3><p>by <?= htmlspecialchars($b['author']) ?></p><p><?= htmlspecialchars($b['description']) ?></p><b>₹<?= number_format((float)$b['price'],2) ?></b></div></article><?php endwhile; ?></div>
<div class="pages"><?php for($i=1;$i<=$pages;$i++): ?><a class="<?= $i===$page?'active':'' ?>" href="?q=<?= urlencode($q) ?>&category=<?= urlencode($cat) ?>&page=<?= $i ?>"><?= $i ?></a><?php endfor; ?></div>
<?php include 'footer.php'; ?>