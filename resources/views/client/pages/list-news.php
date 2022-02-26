<main class="container">
    <div class="mainheading">
        <h1 class="sitetitle"><a href="index.html">Blog Kooding</a></h1>
        <p class="lead">
            Cập nhận tin tức mới nhất của chúng tôi để biết thêm nhiều chương trình khuyến mãi
        </p>
    </div>
    <section class="featured-posts">
        <div class="section-title">
            <h2><span>Bài viết mới nhất</span></h2>
        </div>
        <div class="card-columns listfeaturedtag">
            <?php foreach ($data['list_news_new'] as $item) : ?>
                <!-- begin post -->
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 wrapthumbnail">
                            <a href="newsClient?action=viewDetail&id=<?= $item['id'] ?>">
                                <div class="thumbnail" style="background-image:url(./public/images/upload/<?= $item['image'] ?>);">
                                </div>
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="card-block">
                                <h2 class="card-title"><a href="newsClient?action=viewDetail&id=<?= $item['id'] ?>"><?= $item['title'] ?></a></h2>
                                <h4 class="card-text"><?= substr($item['shortdesc'],0,100) ?>...</h4>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="author-meta">
                                            <span class="post-name"><?= $item['fullname'] ?></span><br />
                                            <span class="post-date"><?= $item['created_at'] ?></span><span class="dot"></span><span class="post-read"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->
            <?php endforeach; ?>

        </div>
    </section>
    <section class="recent-posts">
        <div class="section-title">
            <h2><span>Tất cả bài viết</span></h2>
        </div>
        <div class="card-columns listrecent">
            <?php foreach ($data['list_news'] as $item) : ?>
                <!-- begin post -->
                <div class="card">
                    <a href="newsClient?action=viewDetail&id=<?= $item['id'] ?>">
                        <div class="img_huan_hoa_hong">
                            <img class="img-fluid" src="./public/images/upload/<?= $item['image'] ?>" alt="">
                        </div>
                    </a>
                    <div class="card-block">
                        <h2 class="card-title"><a href="newsClient?action=viewDetail&id=<?= $item['id'] ?>"><?= $item['title'] ?></a>
                        </h2>
                        <h4 class="card-text"><?= substr($item['shortdesc'],0,100) ?>...</h4>
                        <div class="metafooter">
                            <div class="wrapfooter">
                                <span class="author-meta">
                                    <span class="post-name"><?= $item['fullname'] ?></span><br />
                                    <span class="post-date"><?= $item['created_at'] ?></span><span class="dot"></span><span class="post-read"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end post -->
            <?php endforeach; ?>


        </div>
    </section>
</main>