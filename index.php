<?php
if (!defined('BLUDIT')) {
    die('Direkt erişim engellendi.');
}

$siteTitle = $site->title();
$siteDescription = $site->description();
$siteUrl = $site->url();
$isArticle = ($WHERE_AM_I === 'page' && isset($page));
$articles = isset($content) && is_array($content) ? $content : array();
?>
<!doctype html>
<html lang="<?php echo htmlspecialchars(HTML::lang(), ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo htmlspecialchars($isArticle && $page->description() ? $page->description() : $siteDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <title><?php echo htmlspecialchars($isArticle ? $page->title() . ' · ' . $siteTitle : $siteTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <?php
    if (method_exists($site, 'favicon') && $site->favicon()) {
        echo '<link rel="icon" href="' . htmlspecialchars($site->favicon(), ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
    }
    echo Theme::css('css/style.css');
    ?>
</head>
<body>
    <a class="skip-link" href="#main-content">İçeriğe geç</a>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>" aria-label="<?php echo htmlspecialchars($siteTitle, ENT_QUOTES, 'UTF-8'); ?> ana sayfa">
                <span class="brand-mark" aria-hidden="true">✿</span>
                <span><?php echo htmlspecialchars($siteTitle, ENT_QUOTES, 'UTF-8'); ?></span>
            </a>
            <nav class="main-nav" aria-label="Ana gezinme">
                <a href="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>">Ana sayfa</a>
                <a href="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>#yazilar">Yazılar</a>
            </nav>
        </div>
    </header>

    <main id="main-content">
        <?php if ($isArticle) : ?>
            <article class="article">
                <header class="article-header">
                    <a class="back-link" href="<?php echo htmlspecialchars($siteUrl, ENT_QUOTES, 'UTF-8'); ?>#yazilar">← Tüm yazılar</a>
                    <p class="eyebrow"><?php echo htmlspecialchars($page->date(), ENT_QUOTES, 'UTF-8'); ?></p>
                    <h1><?php echo htmlspecialchars($page->title(), ENT_QUOTES, 'UTF-8'); ?></h1>
                    <?php if ($page->description()) : ?>
                        <p class="article-lead"><?php echo htmlspecialchars($page->description(), ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </header>
                <?php if ($page->coverImage()) : ?>
                    <img class="article-cover" src="<?php echo htmlspecialchars($page->coverImage(), ENT_QUOTES, 'UTF-8'); ?>" alt="">
                <?php endif; ?>
                <div class="article-content">
                    <?php echo $page->content(); ?>
                </div>
            </article>
        <?php else : ?>
            <section class="hero" aria-labelledby="hero-title">
                <div class="hero-copy">
                    <p class="eyebrow">Kendine ait bir mevsim</p>
                    <h1 id="hero-title">İlhamın <em>çiçek açsın.</em></h1>
                    <p class="hero-description"><?php echo htmlspecialchars($siteDescription ?: 'Düşüncelere, küçük mutluluklara ve yeni başlangıçlara yer aç.', ENT_QUOTES, 'UTF-8'); ?></p>
                    <a class="button" href="#yazilar">Hikâyeleri keşfet <span aria-hidden="true">→</span></a>
                </div>
                <div class="hero-art" aria-hidden="true">
                    <span class="sun-disc"></span>
                    <span class="flower flower-one">✿</span>
                    <span class="flower flower-two">✿</span>
                    <span class="flower flower-three">✿</span>
                    <span class="art-caption">Baharın<br>yumuşak hali</span>
                </div>
            </section>

            <section class="stories" id="yazilar" aria-labelledby="stories-title">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Not defterinden</p>
                        <h2 id="stories-title">Yeni başlangıçlar</h2>
                    </div>
                    <span class="heading-flourish" aria-hidden="true">✳</span>
                </div>
                <?php if (count($articles) > 0) : ?>
                    <div class="story-grid">
                        <?php foreach ($articles as $article) : ?>
                            <article class="story-card">
                                <a class="story-link" href="<?php echo htmlspecialchars($article->permalink(), ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php if ($article->coverImage()) : ?>
                                        <img class="story-image" src="<?php echo htmlspecialchars($article->coverImage(), ENT_QUOTES, 'UTF-8'); ?>" alt="">
                                    <?php else : ?>
                                        <span class="story-image story-image-placeholder" aria-hidden="true"><span>✿</span></span>
                                    <?php endif; ?>
                                    <span class="story-meta"><?php echo htmlspecialchars($article->date(), ENT_QUOTES, 'UTF-8'); ?></span>
                                    <span class="story-title"><?php echo htmlspecialchars($article->title(), ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php if ($article->description()) : ?>
                                        <span class="story-description"><?php echo htmlspecialchars($article->description(), ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php endif; ?>
                                    <span class="read-more">Devamını oku <span aria-hidden="true">→</span></span>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="empty-state">İlk yazılar burada çiçek açacak. Birazdan yeniden uğra.</p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <span class="footer-flower" aria-hidden="true">✿</span>
        <p><?php echo htmlspecialchars($siteTitle, ENT_QUOTES, 'UTF-8'); ?> <span aria-hidden="true">·</span> Her mevsim kendin ol.</p>
    </footer>
</body>
</html>
