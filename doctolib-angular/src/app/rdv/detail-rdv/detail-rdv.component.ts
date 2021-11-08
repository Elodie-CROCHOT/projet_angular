import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RdvService } from 'src/app/common/rdv.service';

@Component({
  selector: 'app-detail-rdv',
  templateUrl: './detail-rdv.component.html',
  styleUrls: ['./detail-rdv.component.css']
})
export class DetailRdvComponent implements OnInit {

  rdvs
  @Input() rdv


  constructor(private rdvService: RdvService, private router: Router) {
    this.rdvService.selectRdv.subscribe(id => {
      this.rdvService.getDetailRdvById(id).subscribe((response) => {this.rdvs=response.body})
      })
  }

  ngOnInit(): void {
  }

  onDeletedRdv(id: number){
    this.rdvService.deleteRdv(id).subscribe((response)=>{
      if(response.status == 204){
        this.router.navigate([""]);
      }
    })
  }

}
