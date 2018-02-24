<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">编辑角色</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="/">Home</a> <span class="divider">/</span></li>
        <li class="active">编辑角色</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="home">
                        <form id="tab" method="post">
                            <input type="hidden" name="roleid" value="<?php echo ($role_list["roleid"]); ?>" class="input-xlarge" readonly>
                            <label>角色名称</label>
                            <input type="text" name="rolename" value="<?php echo ($role_list["rolename"]); ?>" class="input-xlarge">
                            <label>角色描述</label>
                            <input type="text" name="description" value="<?php echo ($role_list["description"]); ?>" class="input-xlarge">
                            <label></label>
                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i>  提交</button>
                        </form>
                    </div>
                </div>
            </div>

            <footer>
                <p class="pull-right">若水游戏管理系统</p>
                <p>&copy; 2017 <a href="/">Home</a></p>
            </footer>

        </div>
    </div>
</div>