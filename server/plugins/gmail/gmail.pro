######################################################################
# Automatically generated by qmake (2.01a) sam. janv. 19 19:10:01 2008
######################################################################

TEMPLATE = lib
CONFIG -= #DEBUG
CONFIG += plugin qt #DEBUG
QT += network
QT -= gui
INCLUDEPATH += . ../../server ../../lib
TARGET = plugin_gmail
DESTDIR = ../../bin/plugins
DEPENDPATH += . ../../server ../../lib
LIBS += -L../../bin/ -lcommon
MOC_DIR = ./tmp/moc
OBJECTS_DIR = ./tmp/obj
win32 {
QMAKE_CXXFLAGS_WARN_ON += -WX
}
unix {
QMAKE_LFLAGS += -Wl,-rpath,\'\$$ORIGIN\'
QMAKE_CXXFLAGS += -Werror
}

# Input
HEADERS += plugin_gmail.h
SOURCES += plugin_gmail.cpp

