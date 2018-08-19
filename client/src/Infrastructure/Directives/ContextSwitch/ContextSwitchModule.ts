import { NgModule, Type } from '@angular/core';

import { ContextSwitchDirective } from './ContextSwitchDirective';
import { SwitchApplyFunctionDirective } from './SwitchApplyFunctionDirective';
import { SwitchSelectorDirective } from './SwitchSelectorDirective';

// tslint:disable-next-line:no-any
const directives: Type<any>[] = [
    ContextSwitchDirective,
    SwitchSelectorDirective,
    SwitchApplyFunctionDirective
];

@NgModule({
    declarations:[directives],
    exports: [directives],
})
export class ContextSwitchModule { }
