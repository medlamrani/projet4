<?php $title = 'Administration'; ?>

<?php ob_start(); ?>


<section id="articles">
    <div class="container bg-white shadow">
        <div class="row">
            <div class="col-10 offset-1 mb-5 mt-5">
                <h2 class="text-justify" style="36px">Retrouvez les derniers chapitres.</h2>
                <br />
                <hr>
                
                <?php 
                foreach ($postManager->getPosts(0, 5) as $post)
                {
                ?>
                    <article class="mb-5 mt-5">
                    <?php
                    if (strlen($post->content()) <= 200)
                    {
                      $content = $post->content();
                    }
                    
                    else
                    {
                      $debut = substr($post->content(), 0, 200);
                      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                      
                      $content = $debut;
                    }
                  ?>
                  <h4>
                        <a href="index.php?action=post&amp;id=<?= $post->id() ?>"><?= $post->title() ?></a>
                  </h4>
                  
                  <p><?= nl2br($content) ?></p> 

                  <a href="index.php?action=updatePost&amp;id=<?= $post->id() ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Modifier</a>
                  <a href="index.php?action=deletePost&amp;id=<?= $post->id() ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Supprimer</a>
                  <hr>
                    </article>
                <?php
                }
            ?>
            </div>
        </div>
</section>

<section id="commentaire">
        <div class="container bg-white shadow">
            <div class="row">
            <?php
            foreach ($reported as $comment)
            {
            ?>
                <div class="col-10 offset-1 mb-5 mt-5">
                    <h2 class="text-justify" style="36px">Les commentaires signaler.</h2>
                    <div class="text-justify mb-5">Posté par <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['commentDate'] ?></div>
                    <div class="text-justify article-text text-reader"><?= nl2br($comment['content']) ?></div>
                    <a class="btn btn-primary btn-lg active" href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>">Supprimer</a>
                    <a class="btn btn-primary btn-lg active" href="index.php?action=noReportComment&amp;id=<?= $comment['id'] ?>">Approuver</a>
                    <hr>
                </div>    
            <?php
            }
            ?>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . "/templates/adminLayout.php"); ?>