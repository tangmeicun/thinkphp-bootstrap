<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">角色管理</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">角色管理</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <div id="toolbar">
                <a class="btn btn-primary" href="<?php echo U('manager/roleadd');?>" role="button"><i class="icon-plus"></i>新增角色</a>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>角色名称</th>
                        <th>说明</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["roleid"]); ?></td>
                            <td><?php echo ($vo["rolename"]); ?></td>
                            <td><?php echo ($vo["description"]); ?></td>
                            <td>
                                <a href="<?php echo U('manager/roleedit?roleid='.$vo['roleid']);?>"><i class="icon-pencil"></i>编辑   |   </a>
                                <a href="<?php echo U('manager/roleset?roleid='.$vo['roleid']);?>"><i class="icon-pencil"></i>权限设置   |   </a>
                                <a href="<?php echo U('manager/roledel?roleid='.$vo['roleid']);?>" onclick="javascript:return confirm('您确定要删除吗？')"><i class="icon-remove"></i>删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php echo ($data["page"]); ?>
            </div>

            <footer>
    <p>&copy; 2017 若水网络</p>
    <p>作者：Tmc</p>
</footer>
        </div>
    </div>
</div>