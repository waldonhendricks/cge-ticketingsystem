<div class="page-title">
    <div class="container"> <div class="row"> <div class="col-md-12">
        <h1><?php echo __('Frequently Asked Questions');?></h1>
    </div></div></div>
</div>

<div class="cover">
<div class="container"> <div class="row row-no-padding row-eq-height">

    <div class="col-md-4 kb-search">
        <form method="get" action="faq.php" id="kb-search">
            <div class="form-group">
                <input type="hidden" name="a" value="search"/>
                <select class="form-control" name="topicId"  style="width:100%;max-width:100%">
                <option value="">—<?php echo __("Help Topics"); ?>—</option>
                <?php
                $topics = Topic::objects()
                    ->annotate(array('has_faqs'=>SqlAggregate::COUNT('faqs')))
                    ->filter(array('has_faqs__gt'=>0));
                foreach ($topics as $T) { ?>
                        <option value="<?php echo $T->getId(); ?>"><?php echo $T->getFullName();
                            ?></option>
                <?php } ?>
                </select>
                <input type="text" name="q" class="form-control search" placeholder="<?php
                    echo __('Search our knowledge base'); ?>"/>
                <input class="btn btn-default" id="searchSubmit" type="submit" value="<?php echo __('Search');?>">
            </div>
        </form>
		
		<!--/*WH added this- 2018-09-30*/-->
		<form method="get" action="/open.php" id="ticket-open">
            <div class="form-group">
                        <div id="new_ticket" class="action-box">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="act-text">
                                        <h4><?php echo __('Please provide as much detail as possible so we can best assist you');?></h4>
                                       <input class="blue button" id="newTicketSubmit" type="submit" value="<?php echo __('New Ticket');?>">
                                    </div>
                                </div>
                            </div>

                        </div>
             </div>
        </form>
		
    </div>

    <div class="col-md-8 kb-box-cover">
        <div class="kb-box">
            <?php
                $categories = Category::objects()
                    ->exclude(Q::any(array(
                        'ispublic'=>Category::VISIBILITY_PRIVATE,
                        'faqs__ispublished'=>FAQ::VISIBILITY_PRIVATE,
                    )))
                    ->annotate(array('faq_count'=>SqlAggregate::COUNT('faqs')))
                    ->filter(array('faq_count__gt'=>0));
                if ($categories->exists(true)) { ?>
                    <div><?php echo __('Click on the category to browse FAQs.'); ?></div>
                    <ul id="kb">
            <?php
                    foreach ($categories as $C) { ?>
                        <li><i></i>
                        <div>
                        <h4><?php echo sprintf('<a href="faq.php?cid=%d">%s (%d)</a>',
                            $C->getId(), Format::htmlchars($C->getLocalName()), $C->faq_count); ?></h4>
                        <span>
                            <?php echo Format::safe_html($C->getLocalDescriptionWithImages()); ?>
                        </span>
            <?php       foreach ($C->faqs
                                ->exclude(array('ispublished'=>FAQ::VISIBILITY_PRIVATE))
                                ->limit(5) as $F) { ?>
                            <div class="popular-faq"><i class="icon-file-alt"></i>
                            <a href="faq.php?id=<?php echo $F->getId(); ?>">
                            <?php echo $F->getLocalQuestion() ?: $F->getQuestion(); ?>
                            </a></div>
            <?php       } ?>
                        </div>
                        </li>
            <?php   } ?>
                   </ul>
            <?php
                } else {
                    echo __('NO FAQs found');
                }
            ?>
        </div>
    </div>

</div></div>
</div>
