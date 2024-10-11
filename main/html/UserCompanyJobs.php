<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = $_SESSION['username'];
?>

<!-- UserCompanyJobs.css -->
<html>
<html lang="en">
<head>
  <title>User Company Jobs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/UserCompanyJobs.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
        <div class="container-fluid p-5 bg-primary text-white text-left pd">
            <h1>Cyber <span>Resource</span></h1>
            <p>We make hiring easy</p>
        </div>
        <hr>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="./UserCompanySearch.html">company</a></li>
        <li class="active"><a href="./UserCompanyJobs.html">Jobs</a></li>
      </ul><br>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9">
      <h4><small>Search company Profile</small></h4>
      <hr>
      <h2>Ironclad Networks</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Reasearcher</span></h5><br>
      <p>Ironclad Networks isn't your average security company. They're the digital architects who build Fort Knox-level defenses around your data centers and critical systems. Constantly monitored by a team of elite cyber defenders. Ironclad's real-time threat detection system acts like a sophisticated early warning system, identifying and neutralizing digital intruders before they can even breach the perimeter. With Ironclad, your network becomes a secure haven, a fortress against the ever-evolving threats of the digital age.</p>
      <br><br>

      <h2>Cypherstream</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Reasearcher</span></h5><br>
      <p>In today's world, data is king, and protecting it is paramount. They're the data security specialists who build secure tunnels for your information, shielding it from prying eyes across any network. Imagine a bank-grade encryption technology that scrambles your data as it travels public Wi-Fi, private network, it doesn't matter. With Cypherstream, your data becomes unreadable to anyone without the key, ensuring only authorized access and complete confidentiality, no matter where your information journeys.</p>
      <br><br>

      <h2>Nightingale Security</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Reasearcher</span></h5><br>
      <p>Cybercrime thrives in the shadows. It waits, analyzes, and exploits vulnerabilities. But what if you could anticipate the attack before it even happens? Nightingale Security takes a proactive approach to cybersecurity. They're the digital detectives who employ cutting-edge artificial intelligence to analyze vast amounts of data and predict potential threats with uncanny accuracy. Think of them as a digital guardian angel, constantly watching over your systems. Nightingale anticipates and neutralizes cyberattacks before they can strike, keeping your data safe and your operations running smoothly.</p>
      <br><br>

      <h2>ThinkFast Labs</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>
      <h5><span class="label label-danger">Reasearcher</span></h5><br>
      <p>The human element is often the weakest link in any security chain. Hackers know this, and they exploit it through phishing scams, social engineering tactics, and other cunning methods. ThinkFast Labs recognizes this critical gap in defense. They're the cybersecurity educators who empower your users to become the first line of defense. ThinkFast develops engaging and interactive training programs that educate your employees on the latest cyber threats, from malware to ransomware. They teach them how to identify and avoid these threats, transforming your workforce into a vigilant army against cybercrime.</p>
      <br><br>

      <h2>CloudFort</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by John Doe, Sep 24, 2015.</h5>
      <h5><span class="label label-success">Lorem</span></h5><br>
      <p>The cloud offers a world of possibilities for data storage and accessibility. But it can also feel like a gamble CloudFort takes the risk out of the equation. They're the cloud security specialists who offer comprehensive backup and disaster recovery solutions specifically designed for the cloud environment. With CloudFort, your data is always protected, even in the event of a system failure or a cyberattack. Their team of experts ensures your valuable information is constantly backed up and readily available, giving you peace of mind and the confidence to leverage the full power of the cloud.</p>
      <hr>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Footer Text</p>
</footer>

</body>
</html>