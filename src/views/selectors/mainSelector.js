export const selectBehavior = state => state.behaviorReducer.behavior;
export const selectStructure = state => state.structureReducer.structure;
export const selectWorkingDirectory = state => state.structureReducer.workdir;
export const selectFieldStatusForRemove = state => state.fieldReducer.isremove;
