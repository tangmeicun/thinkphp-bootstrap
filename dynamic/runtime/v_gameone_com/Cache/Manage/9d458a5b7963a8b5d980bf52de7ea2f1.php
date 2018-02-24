<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">新增菜单</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="/">Home</a> <span class="divider">/</span></li>
        <li class="active">新增菜单</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="home">
                        <form id="tab" method="post">
                            <label>菜单名称</label>
                            <input type="text" name="name" value="" class="input-xlarge">
                            <label>父级菜单</label>
                            <select name="parentid" id="parentid" class="input-xlarge">
                                <option value="0">顶级菜单</option>
                                <?php if(is_array($data["menuList"])): $i = 0; $__LIST__ = $data["menuList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["menuid"]); ?>"><?php echo ($vo["full_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            <label>地址</label>
                            <input type="text" name="url" value="" class="input-xlarge"> (eq:user-list表示:user/list)
                            <label>图标</label>
                            <input type="text" name="icons" value="" class="input-xlarge">
                            <label></label>
                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i>  提交</button>
                        </form>
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