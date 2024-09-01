# DDoS-IPS
This project offers a cloud-based cybersecurity solution to defend AWS web-based organizations against Distributed Denial of Service attacks and common web application exploits, serving as a limited-breadth Intrusion Prevention System. Features include Web Access Firewall Access Control Lists, network compartmentalization through VPC subnet, secure and durable access to resources through S3, and more to provide a secure foundation for organizations built on AWS Web Applications.

For Installation Instructions and Setup information, visit:
* [this page](https://github.com/shselbst/DDoS-IPS/wiki/Organization-Deployment) which walks you through setting up an example organization. You may alter the organization's details to fit your needs.
* [this page](https://github.com/shselbst/DDoS-IPS/wiki/Security-Solution) which walks you through setting up parts of the solution that are set up after your web application is up and running.


### Features
#### VPC & Subnets
A perfectly secure system is not connected to the internet, but when our organization is based on its Web Application, that is an impossible ideal. Instead, we limit the internet's access to our system. 
We utilize a Virtual Private Cloud, an isolated chunk of AWS's network, to designate a group of private IP addresses that belong to only us. 
We separate this VPC into two subnets, each are a smaller group of IP addresses within the larger range of our VPC. We designate one internal subnet, which can interact with other entities within the VPC but not outside of it as well as an external subnet which can be accessed only by those in the internal VPC but viewed by anyone on the internet.
We put our most valuable resources and most privilegeed users in the internal subnet since it has minimal connections to the outside world.
We put our web application on the external subnet so our users can view it, but we only allow privileged users from within the internal subnet to SSH into it. 
This measure focuses on controlling **who** can access our web application

#### Security Groups
Security groups specify how EC2 Instances which host our users, databases, and web applications can interact with each other and the outside world. 
This measure focuses on controlling **how** attackers can access our system by choosing which ports we allow incoming and outgoing traffic to over.
We define two security groups: internal and external
External allows HTTP traffic and SSH from the internal subnet.
Internal allows RDP from my local machine and SSH from within the internal subnet. It also allows MySQL requests coming from the external subnet.
This way we can make sure only intended types of traffic can make it to our instances, significantly shrinking the space of traffic-types that we must defend against.

#### S3 Bucket Rules
S3 Buckets are used for cloud-based storage of files. 
We define two levels of secrecy to the public in our S3 buckets: Read-only and No Access. The contents of a read-only bucket can be viewed by anyone but only changed by the owner. The contents of a No Access bucket cannot be viewed or changed by anyone but the owner.
In this example organization, we store promotional materials used on our public website (like our logo and pictures of products) on a read-only S3 bucket. We store confidential information like job applications and employee information on a No Access S3 bucket.
This solution allows us to limit who has access to the files our organization relies on and what they can do with them.

#### AWS WAF ACL
The AWS Web Application Firewall with Access Control Lists allows us to choose to turn away or add barriers in the way of traffic trying to reach our web application.
We can use various rules in the Access Control List to **block** traffic we believe is malicious, even if it is traveling from an approved IP on an approved port. 
We can also but barriers like CAPTCHA tests in front traffic we think has a potential to be malicious, hoping to stop them from progressing or limit the amount of non-users from accessing our web application.

More information on this can be found on the [Security Solutions](https://github.com/shselbst/DDoS-IPS/wiki/Security-Solution) page
#### XSS Input Validation Script
Cross-site scripting is a type of web application exploit in which an attacker injects malicious code into an otherwise trustworthy website, typically so that it executes on another user's machine. 
Any part of a web server with user-input that is not validated or normalized is at risk to these attacks. 
Attackers will attempt to insert Javascript enclosed in html tags through user-input to have it executed by the web browser. 
The file linked [here](https://github.com/shselbst/DDoS-IPS/blob/main/xss_sol.sh) can be used as a tool to add this validation in your .php scripts so that attackers cannot have javascript executed. 


