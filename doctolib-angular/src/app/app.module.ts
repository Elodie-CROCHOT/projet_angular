import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { PageAccueilComponent } from './page-accueil/page-accueil.component';
import { NavigationComponent } from './navigation/navigation.component';
import { ProfilComponent } from './profil/profil.component';
import { MedecinsComponent } from './medecins/medecins/medecins.component';
import { PatientsComponent } from './patients/patients/patients.component';
import { HttpClientModule } from'@angular/common/http';
import { PatientService } from './common/patient.service';
import { MedecinService } from './common/medecin.service';
import { ListeMedecinsComponent } from './medecins/liste-medecins/liste-medecins.component';
import { ListePatientsComponent } from './patients/liste-patients/liste-patients.component';
import { DetailMedecinComponent } from './medecins/detail-medecin/detail-medecin.component';
import { RouterModule, Routes } from '@angular/router';
import { DetailPatientComponent } from './patients/detail-patient/detail-patient.component';
import { NgxSpinnerModule } from 'ngx-spinner';
import { RdvsComponent } from './rdv/rdvs/rdvs.component';
import { ListeRdvsComponent } from './rdv/liste-rdvs/liste-rdvs.component';
import { DetailRdvComponent } from './rdv/detail-rdv/detail-rdv.component';
import { RdvService } from './common/rdv.service';
import { FormsModule } from '@angular/forms';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { UserService } from './common/user.service';
import { AuthGuard } from './common/auth.guard';
import { AuthService } from './common/auth.service'

const ROUTES: Routes = [
  {path: "", component: PageAccueilComponent},
  {path: "patients", canActivate: [AuthGuard], component: PatientsComponent},
  {path: "medecins", canActivate: [AuthGuard], component: MedecinsComponent},
  {path: "rdvs", canActivate: [AuthGuard], component: RdvsComponent},
  {path: "inscription", component: InscriptionComponent},
  {path: "connexion", component: ConnexionComponent}
]

@NgModule({
  declarations: [
    AppComponent,
    PageAccueilComponent,
    NavigationComponent,
    ProfilComponent,
    MedecinsComponent,
    PatientsComponent,
    ListeMedecinsComponent,
    ListePatientsComponent,
    DetailMedecinComponent,
    DetailPatientComponent,
    RdvsComponent,
    ListeRdvsComponent,
    DetailRdvComponent,
    InscriptionComponent,
    ConnexionComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    HttpClientModule,
    RouterModule.forRoot(ROUTES),
    NgxSpinnerModule,
    FormsModule
  ],
  providers: [
    PatientService,
    MedecinService,
    RdvService,
    UserService,
    AuthGuard,
    AuthService],
  bootstrap: [AppComponent]
})
export class AppModule { }
