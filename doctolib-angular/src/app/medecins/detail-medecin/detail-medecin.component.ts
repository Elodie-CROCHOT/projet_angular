import { Component, Input, OnInit } from '@angular/core';
import { MedecinService } from '../../common/medecin.service';

@Component({
  selector: 'app-detail-medecin',
  templateUrl: './detail-medecin.component.html',
  styleUrls: ['./detail-medecin.component.css']
})
export class DetailMedecinComponent implements OnInit {

  medecins
  @Input() medecin


  constructor(private medecinService: MedecinService) {
    this.medecinService.selectMedecin.subscribe(id => {
      this.medecinService.getDetailMedecinById(id).subscribe((response) => {this.medecins=response.body})
      })
  }

  ngOnInit(): void {
  }



}
