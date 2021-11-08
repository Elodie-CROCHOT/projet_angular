import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-rdv',
  templateUrl: './rdvs.component.html',
  styleUrls: ['./rdvs.component.css']
})
export class RdvsComponent implements OnInit {

  constructor(private router: Router) { }

  ngOnInit(): void {
  }

}
