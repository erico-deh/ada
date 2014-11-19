<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" href="../../css/browsing/default.css" type="text/css">
    </head>
    <body>
        <a name="top"></a>
        <!-- testata -->
        <div id="header">
            <template_field class="microtemplate_field" name="header">header</template_field>
        </div> <!-- / testata -->
        <!-- menu -->
            <template_field class="microtemplate_field" name="adamenu">adamenu</template_field>  
        <!-- / menu --> 
        <div id="help">
            <template_field class="template_field" name="help">help</template_field>
        </div>
        <!-- contenitore -->
        <div id="container">

            <!-- PERCORSO -->
            <div id="journey">
                <i18n>dove sei: </i18n>
                <span>
                    <template_field class="template_field" name="course_title">course_title</template_field>
                </span>
            </div>
            <!-- / percorso -->
            <div id="status_bar">
                <!--dati utente-->
                <div id="user_data" class="user_data_default">

                    <i18n>utente: </i18n>
                    <span>
                        <template_field class="template_field" name="user_name">user_name</template_field>
                    </span>
                    <div class="status">
                    <i18n>status: </i18n>
                    <span>
                        <template_field class="template_field" name="status">status</template_field>
                    </span>
                </div>
                </div> <!-- / dati utente -->
                <!-- label -->
                <div id="label">
                    <div class="topleft">
                        <div class="topright">
                            <div class="bottomleft">
                                <div class="bottomright">
                                    <div class="contentlabel">
                                        <i18n>Registrazione</i18n>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /label -->
            </div>
            <!-- contenuto -->
            <div id="content">
                <div id="contentcontent" class="contentcontent_default">
                    <div id="help">
                        <!--template_field class="template_field" name="help">help</template_field-->
                    </div>
					<!-- message -->
	                 <div class="contentlabel">
	                     <template_field class="template_field" name="message">message</template_field>
	                 </div>
	            	<!-- /message -->

                    <div id="data">
                        <template_field class="template_field" name="data">data</template_field>
                    </div>                    
                </div>
                <div id="bottomcont">
                </div>
            </div> <!--  / contenuto -->
            <!-- com_tools -->
            <div id="com_tools">
                <div id="topcom_t">
                </div>
                <div id="com_toolscontent">                   
                </div>
                <div id="bottomcom_t">
                </div>
            </div> <!-- /com_tools -->
        </div> <!-- / contenitore -->
        <!-- PIEDE -->
        <div id="footer">
            <template_field class="microtemplate_field" name="footer_guest">footer_guest</template_field>
        </div> <!-- / piede -->
    </body>
</html>
