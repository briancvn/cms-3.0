import { HashLocationStrategy, LocationStrategy } from '@angular/common';
import { NgModule } from '@angular/core';

import { InfrastructureCoreModule } from './InfrastructureCoreModule';

@NgModule({
    imports: [
        InfrastructureCoreModule
    ],
    declarations: [],
    providers: [
        { provide: LocationStrategy, useClass: HashLocationStrategy },
    ],
    exports: [
        InfrastructureCoreModule
    ]
})
export class InfrastructureModule {}
