<?php
if($this->Session->read('ACL1.Dashboard.creator_home'))
echo $this->element('dashboard/creator_home');
if($this->Session->read('ACL1.Dashboard.approver_home'))
echo $this->element('dashboard/approver_home');
if($this->Session->read('ACL1.Dashboard.vacancy_applier_home'))
echo $this->element('dashboard/vacancy_applier_home');
if($this->Session->read('ACL1.Dashboard.vacancy_officer_home'))
echo $this->element('dashboard/vacancy_officer_home');
?>