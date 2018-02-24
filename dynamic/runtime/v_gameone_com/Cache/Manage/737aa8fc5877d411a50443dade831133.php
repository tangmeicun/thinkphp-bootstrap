<?php if (!defined('THINK_PATH')) exit();?>
<!--内容部分start-->
<div class="content">

    <div class="header">
        <h1 class="page-title">系统信息</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="row-fluid">
                <div class="block span6">
                    <a class="block-heading" data-toggle="collapse">系统信息</a>
                    <div id="tablewidget" class="block-body collapse in">
                        <table class="table">
                            <tbody>
                            <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($key); ?></td>
                                    <td><?php echo ($vo); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer>
    <p>&copy; 2017 若水网络</p>
    <p>作者：Tmc</p>
</footer>

        </div>
    </div>
</div>
<!--内容部分end-->