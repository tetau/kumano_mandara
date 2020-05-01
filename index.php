<?php get_header(); ?>

<div class="pTop">

    <section class="pTop_map">
        <div class="l_row"><div class="l_row">
            <div class="pTop_map">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top_map.png" alt="熊野曼陀羅巡礼の地図" class="pTop_map__image">
                <?php if(have_posts()) : ?>
                    <ul class="fz_14 pTop_place__list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $cf_number = get_field('cf_number');
                                    if($cf_number) {
                                        echo '<div class="number">' . esc_attr($cf_number) . '</div>';
                                    }?>
                                    <?php the_title();?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php if(have_posts()) : ?>
                    <ul class="fz_14 pTop_place__num">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    $cf_number = get_field('cf_number');
                                    if($cf_number) {
                                        echo '<span class="num_position">' . esc_attr($cf_number) . '</span>';
                                    }?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div></div>
    </section>
    <section class="pTop_intro l_border">s
        <div class="l_row mx_1100"><div class="l_row pd_side8">
            <h2 class="fz_24 fw700 ltl1 pTop_intro__ttl">熊野曼陀羅巡礼のお誘い</h2>
            <div class="fz_15 pTop_intro__summary">
                <p>近年日本全国各地に多くの霊場が開かれ、巡拝が盛んに行われる様になりました。熊野は、巡礼道の原点、平安時代から始まる「癒しの道」「慈悲の道」であります。</p>
                <p>我々は、一時代を、一生懸命生きてきました。時間的余暇が生まれた今、自分を見つめなおし、これからの永い人生を、自分本来の生きざまを問う巡礼の旅です。</p>
                <p>熊野大権現への霊地、霊場を訪ね、祈りを通じて、我々に歩む道筋をご指示下さいます。</p>
                <p>三十三とは。数字の内一番大きい数字は九です。九を二つ続けて九九となりますと、昔の「人々は、無数にある、無限にという意味を持つ数字だと考えたようです。「九十九島、九十九里浜、九十九曲がり、九十九王子」などは沢山あると言う事です。</p>
                <p>この数にお釈迦さまが悟られた真理、すべての存在をあるがままに知る知恵を「法」と呼びます。仏、法、僧です。 「三帰 (帰依仏、帰依法、帰依僧)」「三界城 (欲の世界、色の世界、無色の世界)」 「三世 (過去、現在、未来)」「三鈷 (仏 教では、煩悩を破砕し、菩提心をあらわす法具)」お釈迦さまは、三の数を重ねることを、九十九と同じ意味として、三十三の数を示し、慈悲に満ちた観音さまが無限に変化して我々の身近に現れ、我々をお助け下さいます。しかし、我々受け取る側で、日々のなかに感じる人と感じない人に別れます。</p>
                <p>熊野曼陀羅霊場は、平安人の心を捉えた熊野大権現 (本地垂迹)「神仏習合」の聖地となり、祈りの人々が神仏の宿る聖地に入る、癒し、慈悲、祈りの道です。</p>
                <p>従来の物流、交易の往来の道とは違う、世界遺産登録にふさわしい「紀伊山地の霊場と参 詣道』あなたの祈 りを、ここに・・・・・</p>
                <p>みなさまに、熊野曼陀羅癒しの霊場をぜひ、お薦めいたします。</p>
            </div>
            <div class="fz_16 fw500 pTop_intro__link"><a href="<?php echo home_url(); ?>/place/">熊野曼陀羅三十三箇所　一覧ページへ</a></div>
        </div></div>
    </section>


    <?php if($terms):?>
        <ul class="aPlace_area__list">
            <?php foreach($terms as $term) :?>
                <li><a href="<?php echo get_term_link($term->slug, $term->taxonomy); ?>"><span><?php echo $term->name; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?><!-- if($terms) -->

        <?php if(have_posts()) : ?>
            <ul class="aPlace_place__list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <li>
                        <?php
                        $attachment_id = get_field('cf_main__image');
                        if($attachment_id) {
                            $thumbnail_src = wp_get_attachment_image_src( $attachment_id, 'original_16-9__lrg' );
                            echo '<a href="' . get_permalink() . '"><figure class="aPlace_place__thumb"><img src="' . esc_html( $thumbnail_src[0] ) . '" class="" alt="' . get_the_title() . '"></figure></a>';
                        }
                        ?>
                        <div class="aPlace_place__head">
                            <h2 class="aPlace_place__ttl"><?php the_title();?></h2>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

    </div>
    <?php get_footer(); ?>


