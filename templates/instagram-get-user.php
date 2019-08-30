<?php
/*
 * Template Name:Get User Instagram
 *
 */
?>
<?php get_header();
global $mytheme;
$accountName = $_GET['account'] ? $_GET['account'] : 'its_zp';
//
require_once IVD_WP_INSTAGRAM_PHP_SCRAPPER . '\vendor\autoload.php';
// If account is public you can query Instagram without auth

$instagram = new \InstagramScraper\Instagram();

// For getting information about account you don't need to auth:

$account = $instagram->getAccount($accountName);

// Available fields EXAMPLE
/*
echo "Account info:\n";
echo "Id: {$account->getId()}\n";
echo "Username: {$account->getUsername()}\n";
echo "Full name: {$account->getFullName()}\n";
echo "Biography: {$account->getBiography()}\n";
echo "Profile picture url: {$account->getProfilePicUrl()}\n";
echo "External link: {$account->getExternalUrl()}\n";
echo "Number of published posts: {$account->getMediaCount()}\n";
echo "Number of followers: {$account->getFollowsCount()}\n";
echo "Number of follows: {$account->getFollowedByCount()}\n";
echo "Is private: {$account->isPrivate()}\n";
echo "Is verified: {$account->isVerified()}\n";*/

$medias = $instagram->getMedias($accountName, 25);

// Let's look at $media

//echo "Media info:\n";
//echo "Id: {$media->getId()}\n";
//echo "Shortcode: {$media->getShortCode()}\n";
//echo "Created at: {$media->getCreatedTime()}\n";
//echo "Caption: {$media->getCaption()}\n";
//echo "Number of comments: {$media->getCommentsCount()}";
//echo "Number of likes: {$media->getLikesCount()}";
//echo "Get link: {$media->getLink()}";
//echo "High resolution image: {$media->getImageHighResolutionUrl()}";
//echo "Media type (video or image): {$media->getType()}";
//$account = $media->getOwner();
//echo "Account info:\n";
//echo "Id: {$account->getId()}\n";
//echo "Username: {$account->getUsername()}\n";
//echo "Full name: {$account->getFullName()}\n";
//echo "Profile pic url: {$account->getProfilePicUrl()}\n";
?>
<div class="wrapper">
    <section class="banner ">
        <h1 class="header"><?= the_title() ?></h1>

    <form class="search" method="get" action="<?= get_permalink()?>" role="search">
        <input type="text" id="account-search-id" class='banner-blog-input' name="account" placeholder="<?php _e( 'Поиск по аккаунту',THEME_OPT ); ?>">
        <input class="search-submit" style="display: none;" type="submit" />
    </form>
    </section>
</div>
<section id="dinamic-content" class="wrap-section privacy_policy ">
    <h2 class='privacy_policy-header header'><?= "Username: {$account->getUsername()}" ?></h2>
    <div class='privacy_policy-content'>
        <img style="border-radius: 50%; max-width: 600px;" src="<?= $account->getProfilePicUrl() ?>">
        <br/>
        <?= $account->getFullName() ?>
        <br/>

        <?= $account->getBiography() ?>
        <br/>

        <?= "{$account->getMediaCount()} публикаций\n"?>
        <br/>

        <?= "Подписки: {$account->getFollowsCount()}\n"?>
        <br/>

        <?= "{$account->getFollowedByCount()} Подписчиков\n"?>
        <br/>

        <?= "приватность аккаунта: {$account->isPrivate()}\n"?>
        <br/>

        <?= "Верифицирован аккаунт: {$account->isVerified()}\n"?>
    </div>
    <hr class="privacy_policy-line">
    <div class='privacy_policy-content'>
        <h2 class='privacy_policy-header header'>Media info:</h2>
        <section class="blog-page">
            <div class="wrap-section">
                <div class="blog-page-list ">
                    <?php if($medias): foreach ($medias as $media) :?>

                        <a class="blog-page-list-item" href="#">
                            <div class="blog-page-list-item-img" style='background-image: url(<?= $media->getImageHighResolutionUrl() ?>)'></div>
                            <span><?= gmdate("d-m-Y\ H:i", $media->getCreatedTime()) ?></span>
                            <div class="blog-page-list-item-info" >
                                <?= "♡ ".$media->getLikesCount() ?>
                                <?= "Тип поста -> ".$media->getType() ?>
                                <?= "⛅  ".$media->getCommentsCount() ?>
                            </div>
                            <span><?= $media->getCaption() ?></span>
                        </a>

                        <?php
//                        echo "Id поста: {$media->getId()}<br/>";
//                        echo "Shortcode: {$media->getShortCode()}<br/>";
//
//                        $account = $media->getOwner();
//                        echo "Инфо аккаунта:<br/>";
//                        echo "Id аккаунта: {$account->getId()}\n";
                        ?>

        <?php endforeach; endif; ?>
        <!-- add empty div -->
        <div class="blog-page-list-item empty-block"></div>
        <div class="blog-page-list-item empty-block"></div>
    </div>
    <hr class="page-line">
</div>
</section>
    </div>
    <hr class="privacy_policy-line">
</section>

<div class="wrap-section">
    <?php get_footer(); ?>
<script>
    $('#account-search-id').on('keydown',function (e) {
      var length = e.target.value.length;
      var inputValue = e.target.value;
      length < 3 ? console.log('sorry min 3 char') : $.get(location.origin + location.pathname+'/?account='+inputValue, function (data) {
        // var data = $(data); // STRING CONVERT TO OBJECT for use to get new element
        $('#dinamic-content').html($(data).find('#dinamic-content').html())
        // $('#dinamic-content').html($(data).find('#dinamic-content').html()).animate({opacity: "1" }, 700, "linear");
        // $( "#dinamic-content" ).load( location.origin + location.pathname+'/?account='+inputValue + "#dinamic-content" );

      });
    })
</script>
