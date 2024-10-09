<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult ['SHOW_ERRORS'] == 'Y' && $arResult ['ERROR'])
	ShowMessage ( $arResult ['ERROR_MESSAGE'] );

//dump($arParams);
//dump($arResult);
CJSCore::Init();
?>
<?
if($arResult["FORM_TYPE"] == "login")
{
?>
<nav class="menu-block">
	<ul>
		<li class="att popup-wrap"><a id="hd_singin_but_open" href="" class="btn-toggle"><?=GetMessage("AUTH_LOGIN_LINK_TEXT")?></a>
			<form class="frm-login popup-block" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
				<div class="frm-title"><?=GetMessage("AUTH_LOGIN_LINK_TEXT")?></div>
				<a href="" class="btn-close"><?=GetMessage("AUTH_LOGIN_LINK_CLOSE_TEXT")?></a>
				<?if($arResult["BACKURL"] <> ''):?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?endif?>
				<?foreach ($arResult["POST"] as $key => $value):?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?endforeach?>
					<input type="hidden" name="AUTH_FORM" value="Y" />
					<input type="hidden" name="TYPE" value="AUTH" />
				<div class="frm-row">
					<input type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="50" value="" size="17" />
					<script>
						BX.ready(function() {
							var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
							if (loginCookie)
							{
								var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
								var loginInput = form.elements["USER_LOGIN"];
								loginInput.value = loginCookie;
							}
						});
					</script>
				</div>
				<div class="frm-row">
					<input type="password" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" />			
				</div>
				<div class="frm-row">
					<a href="/login/?forgot_password=yes" class="btn-forgot"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
				</div>
				<div class="frm-row">
					<div class="frm-chk">
						<input type="checkbox" id="login" name="USER_REMEMBER" value="Y"> <label for="login"><?=GetMessage("AUTH_REMEMBER_ME_SHORT")?></label>
					</div>
				</div>
				<div class="frm-row">
					<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
				</div>

				<?if($arResult["AUTH_SERVICES"]):?>
				<?
				$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
					array(
						"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
						"SUFFIX"=>"form",
						"AUTH_URL"=>$arResult["AUTH_URL"],
						"POST"=>$arResult["POST"],
					),
					$component,
					array("HIDE_ICONS"=>"Y")
				);
				?>
				<?endif?>
			</form></li>
		<li><a href="/login/?register=yes"><?=GetMessage("AUTH_REGISTER")?></a></li>
	</ul>
</nav>
<?
}
else
{
	?>
	<?php 
	$rsUser = CUser::GetById($USER->GetID());
	$arUser = $rsUser->Fetch();
	?>
	<nav class="menu-block">
        <ul>
        	<li>
                <a href="/login/user.php" ><?=$arUser["NAME"];?> <?=$arUser["LAST_NAME"];?> [<?= $arUser["LOGIN"];?>]</a>
            </li>
            <li><a href="?logout=yes&sessid=<?=$_SESSION["fixed_session_id"]?>">Выйти</a>
            </li>
        </ul>
    </nav>
	<?
}
?>
