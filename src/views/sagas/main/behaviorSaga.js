import { select, call, fork, takeLatest, put, join } from "redux-saga/effects";
import common from "../../utils/common";
import { rebuildWorkdir, rebuildStructure } from "./modules/generator";
import {
  selectStructure,
  selectWorkingDirectory
} from "../../selectors/mainSelector";
import {
  getStructure,
  printWorkingDirectory,
  getFileContent
} from "../../actions/mainAction";

function doAsync(params) {
  const pathto = "/api/main.php";
  return common.callFetch(params, pathto);
}

function* fetchListBucket() {
  const params = { actionType: "initiate" };
  const response = yield call(doAsync, params);
  const resources = JSON.parse(response);
  let structure = yield select(selectStructure);
  structure.set(structure.size, resources);
  yield put(getStructure("change", structure));
}

function* fetchResources(props) {
  let params = props.payload;
  let workdir = yield select(selectWorkingDirectory);
  workdir = yield call(rebuildWorkdir, workdir, params.hierarchy);
  params.actionType = "change";
  params.path = workdir;
  let response = yield call(doAsync, params);
  response = JSON.parse(response);
  if (response.isFile === false) {
    const structure = yield select(selectStructure);
    const newStructure = yield call(
      rebuildStructure,
      structure,
      params.hierarchy
    );
    newStructure.set(newStructure.size, response.result);
    yield put(getStructure("change", newStructure));
    const nextWorkdir =
      workdir !== "" ? [workdir, params.name].join("/") : params.name;
    yield put(printWorkingDirectory(nextWorkdir));
  } else {
    yield put(getFileContent(response.result));
  }
}

const behaviorSaga = [
  takeLatest("INITIATE", fetchListBucket),
  takeLatest("CLICK_ROW", fetchResources)
];

export default behaviorSaga;
