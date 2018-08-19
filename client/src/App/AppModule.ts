import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';

import { InfrastructureCoreModule } from '../Infrastructure';
import { ROUTES } from './AppRoutes';
import { APP_COMPONENTS, APP_ENTRY_COMPONENTS } from './Components';
import { AppComponent } from './Components/AppComponent';

@NgModule({
    imports: [
        BrowserModule,
        InfrastructureCoreModule,
        RouterModule.forRoot(ROUTES)
    ],
    declarations: [
        AppComponent,
        ...APP_COMPONENTS
    ],
    entryComponents: [
        ...APP_ENTRY_COMPONENTS
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule { }
