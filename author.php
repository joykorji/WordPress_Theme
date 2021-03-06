<?php  get_header() ?>

<div class="container author-page">
    <h1 class="profile-header text-center"><?php the_author_meta('nickname')?> Page </h1>
    <div class="author-main-info">
        <div class="row">
            <div class="col-md-3">
                        
            <?php
                $avatar_arguments  = array(
                    'class' => 'img-responsive img-thumbnail center-block'
                );

                echo get_avatar( get_the_author_meta('ID'), 196, '', 'User avatar', $avatar_arguments);
            ?>
            </div>
            <div class="col-md-9">
                <ul class="author-names list-unstyled">
                    <li><span>First Name: </span> <?php the_author_meta( 'first_name') ?></li>
                    <li><span>Last Name: </span> <?php the_author_meta( 'last_name') ?></li>
                    <li><span>Nickname: </span> <?php the_author_meta('nickname')?></li>
                </ul>
                <hr>
                <?php  if (get_the_author_meta('description')){  ?> 
                                
                            <p>
                                <?php the_author_meta('description') ?> 
                            </p>
                <?php }else{
                            echo 'there is no Biography';
                }       ?>  
            </div>
        </div>
    </div>

    <div class="row author-stats">
        <div class="col-md-3">
            <div class="stats">
            Posts Count
            
            <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Comments Count
            
            <span>
                <?php
                    $commentscount_arguments = array( 
                        'user_id' => get_the_author_meta('ID'),
                        'count'   => true

                    );
                    echo get_comments($commentscount_arguments)
                ?>

            </span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Total Post view
            
            <span>0</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats">
                Testing
            
            <span>0</span>
            </div>
        </div>
        
        
    </div>
    <div class="row">
        <?php

            
            $author_posts_arguments = array (
                'author'         => get_the_author_meta('ID'),
                'posts_per_page' => -1   //this will bring all the posts 
            );
            $author_posts = new WP_Query($author_posts_arguments);

            if($author_posts->have_posts()) {   ?> 

                <h3 class="author-posts-title"> Latest Posts Of <?php the_author_meta('nickname')?>  </h3>

                <?php
                while($author_posts->have_posts()){


                    $author_posts->the_post(); ?>
                    <div class="author-posts">
                        <div class="row">
                            <div class="col-sm-2">
                                <?php the_post_thumbnail( '', ['class' => 'img-responsive img-thumbnail', 'title' => 'post Image']) ?>
                            </div>

                            <div class="col-sm-10">
                                
                                <h3 class="post-title">
                                    <a href="<?php the_permalink() ?>"> <?php the_title() ?></a>
                                </h3>

                                
                                <span class="post-date"><i class="fa fa-calendar fa-fw "></i> <?php the_time('F j, Y') ?>, </span>

                                <span class="post-comments"><i class="fa fa-comments-o fa-fw "></i><?php comments_popup_link( '0', 'one comment', '% comments' , 'comment-url') ?> </span>
                                
                                <div class="post-content">
                                    <?php the_excerpt( )  ?>
                                </div>
                                    
                            </div>
                        </div>
                    </div>
                <div class="clearfix"></div>
                    <?php
                
                }
            }
         wp_reset_postdata();

            
         $comments_arguments = array (
            'user_id'     => get_the_author_meta('ID'),
            'status'      =>    'approve',
            'number'      =>    6,
            'post_status' => 'publish',
            'post_type'   => 'post'
         );
         $comments = get_comments($comments_arguments);

         if($comments){  ?>
         <h3 class="author-comments-title">
         <?php 

         echo 'Latest Comments: '; ?>
         
         </h3>

         <?php 
            foreach ($comments as $comment) { ?> 

                <div class="author-comments">
                    <h3 class="post-title">
                        <a href="<?php echo get_permalink($comment->comment_post_ID) ?>" >
                             <?php echo get_the_title($comment->comment_post_ID) ?>
                        </a>
                    </h3>
                
                    <span class="post-date">
                        <i class="fa fa-calendar fa-fw"></i>
                        <?php echo 'Added on ' . mysql2date('l, F j, Y', $comment->comment_date); ?>
                    </span>

                    <div class="post-content">
                        <?php echo $comment->comment_content ?>                    
                    </div>

                </div>
                 
                
               
    
               
        <?php 
            }
         } else {
             echo 'This user doesn\'t have any comments';
         }
         

        ?>
    </div>

</div>

<?php get_footer() ?> 