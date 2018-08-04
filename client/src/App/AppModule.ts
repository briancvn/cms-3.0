import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { InfrastructureCoreModule } from '../Infrastructure';
import { AppComponent } from './AppComponent';

@NgModule({
    imports: [
        BrowserModule,
        InfrastructureCoreModule
    ],
    declarations: [
        AppComponent
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule { }
