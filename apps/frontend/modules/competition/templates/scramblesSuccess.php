<div id="comeptition_scrambles" data-role="page" data-add-back-btn=”true” data-theme="a">
    <?php include_partial('global/header', array('title' => $event['cellname'])) ?>
    <div data-role="content">
        <ul data-role="listview" data-theme="a" data-divider-theme="a">
            <?php foreach ($scrambles as $roundName => $rounds): ?>
                <?php foreach ($rounds as $groupId => $groups): ?>
                    <li data-role="list-divider">
                        <?php echo $roundName.'&nbsp;-&nbsp;Group&nbsp;'.$groupId ?>
                    </li>
                     <?php foreach ($groups as $group): ?>
                        <li>
                             <?php if (isset($shortId)): ?>
                                 <?php $size = $shortId >= 6 ? 250 : $shortId >= 4 ? 150 : 100 ?>
                                 <div class="scramble_image"><img src="http://iwca.jp/images/vcube/visualcube.php?size=<?php echo $size ?>&pzl=<?php echo $shortId ?>&alg=<?php echo $group['scramble'] ?>&sch=wgryob&bg=t&fmt=png"></div>
                             <?php endif; ?>
                             <?php if ($group['isextra']): ?>
                                 <span class="results-time"><?php echo 'Extra&nbsp;#'.$group['scramblenum'] ?></span><br />
                             <?php else: ?>
                                 <span class="results-time"><?php echo '#'.$group['scramblenum'] ?></span><br />
                             <?php endif; ?>
                             <?php echo $group['scramble'] ?><br />
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
