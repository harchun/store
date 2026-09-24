<?php
$current=get_the_ID();
$terms=wp_get_post_terms($current,array('store_city','store_type'),array('fields'=>'ids'));
$args=array('post_type'=>'post','posts_per_page'=>3,'post__not_in'=>array($current));
if(!is_wp_error($terms)&&$terms) $args['tax_query']=array('relation'=>'OR',array('taxonomy'=>'store_city','field'=>'term_id','terms'=>$terms),array('taxonomy'=>'store_type','field'=>'term_id','terms'=>$terms));
$q=new WP_Query($args);
if($q->have_posts()): ?><section class="section related-stores"><div class="section-head"><div><span class="eyebrow">DISCOVER MORE</span><h2>你可能也會有興趣</h2></div></div><div class="store-grid"><?php while($q->have_posts()):$q->the_post(); get_template_part('template-parts/store-card'); endwhile; ?></div></section><?php endif; wp_reset_postdata();
