<main class="container">
    <div class="mainheading">
        <h1 class="sitetitle concax"><a href="newsClient">Blog Kooding</a></h1>
        <p class="lead">
            <?= $data['news_detail']['shortdesc'] ?>
        </p>
    </div>
    <div class="conten_news">
        <?= $data['news_detail']['content'] ?>
    </div>
    <div class="graybg">
        <div class="container">
            <div class="row listrecent listrelated">
                <?php foreach ($data['list_news_relate'] as $item) : ?>
                    <!-- begin post -->
                    <div class="col-md-4">
                        <div class="card">
                            <a class="post_link_img" href="post.html">
                                <img class="img-fluid img-thumb" src="./public/images/upload/<?= $item['image'] ?>" alt="">
                            </a>
                            <div class="card-block">
                                <h2 class="card-title"><a href="post.html"><?= substr($item['title'],0,30) ?></a></h2>
                                <h4 class="card-text">
                                <?= substr($item['shortdesc'],0,120) ?>...
                                </h4>
                                <div class="metafooter">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end post -->
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</main>