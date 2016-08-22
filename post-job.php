<?php
session_start();
ob_start();
require("config.php");
$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) OR DIE(mysqli_connect_errno());
if ($_SESSION["bw_auth"] != "true") {
    header("location:index.php?page=post");
}
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Post Opening | RefYaar</title>
        <link rel="shortcut icon" href="https://s3.amazonaws.com/refyaar/staticContent/img/favicon.ico">
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/theme.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/view-job-actions.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/css/jquery.tokenize.css" type="text/css" rel="stylesheet" />
        <link href="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.css" type="text/css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.tokenize.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/includes/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/custom/post-job.js" type="text/javascript"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/565e002faad22388665e7fab/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </head>
    <body>
        <?php include './header.php'; ?>
        <div class="page-wrapper">
            <div class="col-md-11 margin-auto clearfix page-container clearfix">
                <div class="clearfix">
                    <div class="ref-head-xl text-left col-xs-12">
                        Post an Opening
                    </div>
                </div>
                <br class="hidden-xs visible-md"/>
                <br class="hidden-xs visible-md"/>

                <div class="col-xs-12 col-md-9 col-sm-11 clearfix">
                    <form method="post" id="create-post-job"  action="src/post-job/create-post-job.php">
                        <div class="col-md-12 no-padding clearfix">
                            <div class="ref-container-left clearfix">
                                <div id="post-job-error" class="alert alert-danger hidden"></div>
                                <div class="ref-form-container">
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Organization Name
                                            </div>
                                            <input type="text" name="organizationName" id="organizationName" class="form-control ref-form-control" value="" placeholder="Organization Name">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Job Headline
                                            </div>
                                            <input type="text" name="headline" id="headline" class="form-control ref-form-control" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                Functional Area
                                            </div>
                                            <select id="funcArea" name="funcArea" class="form-control ref-form-control" placeholder="Current Company">
                                                <option>
                                                    Functional Area
                                                </option>
                                                <?php
                                                $query1 = "select id, area from  func_area where status='Active' order by area";
                                                $stmt1 = $con->prepare($query1);
                                                $stmt1->execute();
                                                $stmt1->bind_result($funcId, $area1);
                                                $stmt1->store_result();
                                                while ($stmt1->fetch()) {
                                                    echo "<option value='$funcId'>$area1</option>";
                                                }
                                                $stmt1->close();
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-6 no-padding clearfix">
                                                <div class="ref-form-sub-text no-padding col-md-12 no-padding ref-form-elt">
                                                    Required Experience
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <select name="minExp" id="minExp" class="form-control ref-form-control">
                                                        <option>Min</option>
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                        <option>13</option>
                                                        <option>14</option>
                                                        <option>15</option>
                                                        <option>16</option>
                                                        <option>17</option>
                                                        <option>18</option>
                                                        <option>19</option>
                                                        <option>20</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 ref-form-label no-padding text-center">
                                                    To
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <select name="maxExp" id="maxExp" class="form-control ref-form-control">
                                                        <option>Max</option>
                                                        <option>0</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                        <option>13</option>
                                                        <option>14</option>
                                                        <option>15</option>
                                                        <option>16</option>
                                                        <option>17</option>
                                                        <option>18</option>
                                                        <option>19</option>
                                                        <option>20</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2 no-padding">

                                                </div>
                                            </div>
                                            <div class="col-md-6 no-padding">
                                                <div class="ref-form-sub-text no-padding ref-form-elt">
                                                    Location
                                                </div>
                                                <select id="city" name="city" class="form-control ref-form-control">
                                                    <option> 
                                                        Select city
                                                    </option>
                                                    <?php
                                                    $query1 = "select a.id,a.city from location__city a, location__state b, location__country c where b.id=a.state_id and c.id=b.country_id and c.country='India'";
                                                    $stmt1 = $con->prepare($query1);
                                                    $stmt1->execute();
                                                    $stmt1->bind_result($cityId, $city);
                                                    $stmt1->store_result();
                                                    while ($stmt1->fetch()) {
                                                        echo "<option value='$cityId'>$city</option>";
                                                    }
                                                    $stmt1->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-12">
                                            <div class="ref-form-sub-text no-padding">
                                                Keywords (Please fill in your Keywords carefully as all the candidates recommended to you would be based on these keywords.)
                                                <br/>
                                                    <p>
                                                         
                                                    </p>
                                            </div>
                                            <select id="keyword" name="keyword[]" placeholder="Key Skill" class="skill-tok single-autocomplete autocomplete"/>
                                            </select>

                                            <!--<textarea type="text"  class="form-control ref-form-control" rows="3" placeholder="Keywords"></textarea>-->
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-12">
                                            <div class="ref-form-sub-text no-padding">
                                                Detailed Job Description
                                            </div>
                                            <textarea type="text" id="detailDesc" name="detailDesc" class="form-control ref-form-control" rows="7" placeholder="Job Description"></textarea>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                    <div class="ref-form-box clearfix">
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text">
                                                <!--Additional Information ( Optional )-->
                                                Is a Post-Graduation Degree Required?
                                            </div>
                                            <select name="additional" id="additional" class="form-control ref-form-control">
                                                <option value="1">Yes</option>
                                                <option selected="selected" value="0">No</option>
                                            </select>
                                            <!--<input name="additional" id="additional" type="text" class="form-control ref-form-control" />-->
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                CTC in INR (Optional)
                                            </div>
                                            <input type="text" name="ctc" id="ctc" class="form-control ref-form-control">
                                        </div>
                                        </div>
                                        <br/>
                                        <div class="ref-form-box clearfix">
                                            <div class="col-md-12">
                                            <div class="ref-form-sub-text ref-form-elt">
                                                Detailed Job Description - As Attachment (Optional)
                                            </div>
                                            <input type="file" name="jd" id="jd" class="form-control ref-form-control">
                                        </div>
                                    </div>
                                    
                                    <br>
                                </div>

                            </div>
                        </div>
                        <div class="text-right clearfix">
                            <br/>
                            <br/>
                            <br/>
                            <input type="submit" value="SUBMIT" class="blue-btn">
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 ref-container-right col-md-3 clearfix">
                    <!--<h3 style="">Advertise Here</h3>-->
                    <div style="height: 150px;">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- RefYaar - Demo -->
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="ca-pub-2072883661383317"
                                         data-ad-slot="6602520781"
                                         data-ad-format="auto">
                                    </ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                    </div>
                    <br/>
                    <!--<div class="advertise" style="height: 400px;">

                    </div>-->
                </div>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div id="post-container-error" class="alert alert-danger hidden"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="clickscrollTop" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './footer.php'; ?>

        <!-- external javascript -->

        <script src="https://s3.amazonaws.com/refyaar/staticContent/js/jquery.form.min.js"></script>
    </body>
</html>
